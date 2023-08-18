<? include $_SERVER['DOCUMENT_ROOT']."/config/db.php";

function getAll($link, $table){
    $query = "SELECT * FROM {$table}";
    $result = mysqli_query($link, $query);
    if(!$result)
        die(mysqli_error($link));
    $n = mysqli_num_rows($result);
    $res = array();
    for($i = 0; $i < $n; $i++){
        $row = mysqli_fetch_assoc($result);
        $res[] = $row;
    }
    return $res;
}

function getOneUser($link, $login)
{
    $query = sprintf("SELECT `id`, `login`, `password`, `name`, `sername`, `photo`, `dateReg`, `role` FROM `users` WHERE `login`='$login'");
    $result = mysqli_query($link, $query);
    if (!$result)
        die(mysqli_error($link));
    $res = mysqli_fetch_assoc($result);
    return $res;
}

function setNewPerson($link,$name,$serName,$old,$telephone,$curse,$start,$comment,$dateTrial,$namePerent,$status)
{
    $query = "INSERT INTO `student`(`name`, `sername`, `old`, `telephone`, `curse`, `start`, `comment`, `dateTrial`, `namePerent`, `status`, `trainingGroup`,`trainingEvent`) VALUES ('$name','$serName','$old','$telephone','$curse','$start','$comment','$dateTrial','$namePerent','$status','','')";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}
function setNewCourses($link,$title,$day,$startTime,$endTime,$howMany,$minAge,$maxAge,$dateStart,$dateEnd)
{
    $query = "INSERT INTO `courses`(`title`, `day`, `startTime`, `endTime`, `howMany`, `minAge`, `maxAge`, `dateStart`,`dateEnd`,`status`) VALUES ('$title','$day','$startTime','$endTime','$howMany','$minAge','$maxAge','$dateStart','$dateEnd','1')";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}
function setCourseForIdpeople($link,$idPerson){
    $query = sprintf("SELECT `name`,`trainingGroup`,`trainingEvent` FROM `student` WHERE `id`='$idPerson'");
    $result = mysqli_query($link, $query);
    if (!$result)
        die(mysqli_error($link));
    $res = mysqli_fetch_assoc($result);
    return $res;
}
function updateCoursePerson($link,$idCourse,$idPerson){
     $BeCourse = setCourseForIdpeople($link,$idPerson);
     $course = $BeCourse['trainingGroup'];
     if ($course=='0'){
        $query = "UPDATE `student` SET `trainingGroup`='$idCourse' WHERE `id`='$idPerson'";
        if (mysqli_query($link, $query)) {
            return 1;
        }
    } else {
        $newCourse = $course.','.$idCourse;
        $query = "UPDATE `student` SET `trainingGroup`='$newCourse' WHERE `id`='$idPerson'";
        if (mysqli_query($link, $query)) {
            return 1;
        }
    }
    
}
function updateCoursePersonForDelete($link,$idCourse,$idPerson){
        $query = "UPDATE `student` SET `trainingGroup`='$idCourse' WHERE `id`='$idPerson'";
        if (mysqli_query($link, $query)) {
            return 1;
}}


function deleteCoursePerson($link,$course,$people){
    $newMyCourse = Array();
    $BeCourse = setCourseForIdpeople($link,$people);
    $myCourse = explode(',', $BeCourse['trainingGroup']);
    foreach($myCourse as $item){
        if($course!=$item){
            array_push($newMyCourse,$item);
        }
    }
    if(count($newMyCourse)==0){
        $myCourse2=0;
    } else {
    $myCourse2 = implode(',',$newMyCourse);
    }
    updateCoursePersonForDelete($link,$myCourse2,$people);
    
}
function updateProfilePerson($link,$id,$name,$serName,$old,$telephone,$curse,$start,$comment,$dateTrial,$namePerent,$status)
{
    $query = "UPDATE `student` SET `name`='$name',`sername`='$serName',`old`='$old',`telephone`='$telephone',`curse`='$curse',`start`='$start',`comment`='$comment',`dateTrial`='$dateTrial',`namePerent`='$namePerent',`status`='$status' WHERE `id`='$id'";
        if (mysqli_query($link, $query)) {
            return 1;
}
}
function writeVisitedCoursePeople($link,$idPeople,$idCourse,$dateVisit){
    $getAllPeopleVisited = getAll($link, 'visited');
    foreach($getAllPeopleVisited as $people){
         if($people['idPeople']==$idPeople&&$people['idCourse']==$idCourse){
            $newVisited = $people['dateVisit'];
             $flag=1;
             break;
         } else {
            $flag=0;
         }
    }
    if ($flag==0){
        createVisitedCoursePeople($link,$idPeople,$idCourse);
        writeVisitedCoursePeopleNew($link,$idPeople,$idCourse,$dateVisit);
    } else {
        if($newVisited==''){
            $newVisited=$dateVisit;
            writeVisitedCoursePeopleNew($link,$idPeople,$idCourse,$newVisited);
        } else {
            $dateVisitHistory = explode('|', $newVisited);
            foreach($dateVisitHistory as $key => $tag_name){
                if ($tag_name==$dateVisit){
                    $flagСoincidence=1;
                    unset($dateVisitHistory[$key]);
                    break;
                } else {
                    $flagСoincidence=0;
                }
            }
            if($flagСoincidence==0){
                $newVisited=$newVisited.'|'.$dateVisit;
                getLog($link, 'Ученику с id '.$idPeople.' добавили посещение '.$dateVisit.' в курсе с id '.$idCourse);
                writeVisitedCoursePeopleNew($link,$idPeople,$idCourse,$newVisited);
            } else {
                $newVisited = implode('|', $dateVisitHistory);
                
                getLog($link, 'Ученику с id '.$idPeople.' удалили посещение '.$dateVisit.' в курсе с id '.$idCourse);
                writeVisitedCoursePeopleNew($link,$idPeople,$idCourse,$newVisited);
            }
        }
        
    }
}
function createVisitedCoursePeople($link,$idPeople,$idCourse){
    $query = "INSERT INTO `visited`(`idPeople`, `idCourse`,`dateVisit`) VALUES ('$idPeople','$idCourse','')";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}
function writeVisitedCoursePeopleNew($link,$idPeople,$idCourse,$dateVisit){
    $query = "UPDATE `visited` SET `dateVisit`='$dateVisit'  WHERE `idPeople`='$idPeople' AND `idCourse`='$idCourse'";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}

function getOneVisitedFromIdPersonAndpdCourse($link, $idPeople,$idCourse)
{
    $query = sprintf("SELECT `id`, `idPeople`, `idCourse`, `dateVisit` FROM `visited` WHERE `idPeople`='$idPeople' AND `idCourse`='$idCourse'");
    $result = mysqli_query($link, $query);
    if (!$result)
        die(mysqli_error($link));
    $res = mysqli_fetch_assoc($result);
    return $res;
}

//--------------------

function writePayCoursePeople($link,$idPeople,$idCourse,$datePay){
    $getAllPeoplePay = getAll($link, 'payment');
    foreach($getAllPeoplePay as $people){
         if($people['idPeople']==$idPeople&&$people['idCourse']==$idCourse){
            $newPay = $people['datePay'];
             $flag=1;
             break;
         } else {
            $flag=0;
         }
    }
    if ($flag==0){
        createPayCoursePeople($link,$idPeople,$idCourse);
        writePayCoursePeopleNew($link,$idPeople,$idCourse,$datePay);
    } else {
        if($newPay==''){
            $newPay=$datePay;
            writePayCoursePeopleNew($link,$idPeople,$idCourse,$newPay);
        } else {
            $datePayHistory = explode('|', $newPay);
            foreach($datePayHistory as $key => $tag_name){
                if ($tag_name==$datePay){
                    $flagСoincidence=1;
                    unset($datePayHistory[$key]);
                    break;
                } else {
                    $flagСoincidence=0;
                }
            }
            if($flagСoincidence==0){
                $newPay=$newPay.'|'.$datePay;
                getLog($link, 'Ученику с id '.$idPeople.' добавили оплату '.$datePay.' в курсе с id '.$idCourse);
                writePayCoursePeopleNew($link,$idPeople,$idCourse,$newPay);
            } else {
                $newPay = implode('|', $datePayHistory);
                
                getLog($link, 'Ученику с id '.$idPeople.' удалили оплату '.$datePay.' в курсе с id '.$idCourse);
                writePayCoursePeopleNew($link,$idPeople,$idCourse,$newPay);
            }
        }
        
    }
}
function createPayCoursePeople($link,$idPeople,$idCourse){
    $query = "INSERT INTO `payment`(`idPeople`, `idCourse`,`datePay`) VALUES ('$idPeople','$idCourse','')";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}
function writePayCoursePeopleNew($link,$idPeople,$idCourse,$datePay){
    $query = "UPDATE `payment` SET `datePay`='$datePay'  WHERE `idPeople`='$idPeople' AND `idCourse`='$idCourse'";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}

function getOnePayFromIdPersonAndpdCourse($link, $idPeople,$idCourse)
{
    $query = sprintf("SELECT `id`, `idPeople`, `idCourse`, `datePay` FROM `payment` WHERE `idPeople`='$idPeople' AND `idCourse`='$idCourse'");
    $result = mysqli_query($link, $query);
    if (!$result)
        die(mysqli_error($link));
    $res = mysqli_fetch_assoc($result);
    return $res;
}

// получить массив дат по номеру месяца
function setDateMounth($numberMounth){
    $start = strtotime(date('Y-'.$numberMounth.'-01'));
    $finish = strtotime(date('Y-'.$numberMounth.'-t'));
    $array = array();
    for($i = $start; $i <= $finish; $i += 86400) {
        $list = explode('.', date('d.m', $i));
        $array[] = implode('.', $list);
    
    }
    return($array);
}

function getDateNow(){
    date_default_timezone_set( 'Europe/Moscow' );
    return date("d.m.y H:i");
}

function getLog($link, $type){
    $dateNow = getDateNow();
    $query = "INSERT INTO `log`(`type`, `date`) VALUES ('$type','$dateNow')";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}
function getNewPay($link, $idStudent,$datePay,$pricePay,$commentPay){
    $query = "INSERT INTO `pay`(`idStudent`, `datePay`, `pricePay`, `commentPay`) VALUES ('$idStudent','$datePay','$pricePay','$commentPay')";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}
function getOneSrudentForId($link, $id)
{
    $query = sprintf("SELECT * FROM `student` WHERE `id`='$id'");
    $result = mysqli_query($link, $query);
    if (!$result)
        die(mysqli_error($link));
    $res = mysqli_fetch_assoc($result);
    return $res;
}

function updatePayChange($link,$idOperation,$datePay,$pricePay,$commentPay,$idStudent){
    $query = "UPDATE `pay` SET `idStudent`='$idStudent',`datePay`='$datePay',`pricePay`='$pricePay',`commentPay`='$commentPay' WHERE `id`='$idOperation'";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}

function deletePayOperation($link,$idOperation){
    $query = "DELETE FROM `pay` WHERE `id`='$idOperation'";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}

function getNewCost($link, $date,$price,$comment){
    $query = "INSERT INTO `costs`(`date`, `price`, `comment`) VALUES ('$date','$price','$comment')";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}

function updateCostChange($link,$idCost,$date,$price,$comment){
    $query = "UPDATE `costs` SET `date`='$date',`price`='$price',`comment`='$comment' WHERE `id`='$idCost'";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}

function costDelete($link,$idCost){
    $query = "DELETE FROM `costs` WHERE `id`='$idCost'";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}

function newEvent($link, $titleEvent,$day,$startTimeEvent,$endTimeEvent,$countPeople,$minAge,$maxAge,$dateStart,$dateEnd,$price){
    $query = "INSERT INTO `event`( `title`, `day`, `startTime`, `endTime`, `countPeople`, `minAge`, `maxAge`, `dateStart`, `dateEnd`,`price`,`status`) VALUES ('$titleEvent','$day','$startTimeEvent','$endTimeEvent','$countPeople','$minAge','$maxAge','$dateStart','$dateEnd','$price','1')";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}
function setOneEventForId($link,$id){
    $query = sprintf("SELECT * FROM `event` WHERE `id`='$id'");
    $result = mysqli_query($link, $query);
    if (!$result)
        die(mysqli_error($link));
    $res = mysqli_fetch_assoc($result);
    return $res;
}

//получаем даты из интервала
function get_dates($start, $end, $format = 'Y-m-d')
{
	$day = 86400;
	$start = strtotime($start . ' -1 days');
	$end = strtotime($end . ' +1 days');
	$nums = round(($end - $start) / $day); 

	$days = array();
	for ($i = 1; $i < $nums; $i++) { 
		$days[] = date($format, ($start + ($i * $day)));
	}

	return $days;
}

function updateEventPerson($link,$idEvent,$idPerson){
    $BeEvent = setCourseForIdpeople($link,$idPerson);
    $event = $BeEvent['trainingEvent'];
    if ($event==''){
       $query = "UPDATE `student` SET `trainingEvent`='$idEvent' WHERE `id`='$idPerson'";
       if (mysqli_query($link, $query)) {
           return 1;
       }
   } else {
       $newCourse = $event.','.$idEvent;
       $query = "UPDATE `student` SET `trainingEvent`='$newCourse' WHERE `id`='$idPerson'";
       if (mysqli_query($link, $query)) {
           return 1;
       }
   }
   
}

function deleteEventPerson($link,$course,$people){
    $newMyCourse = Array();
    $BeCourse = setCourseForIdpeople($link,$people);
    $myCourse = explode(',', $BeCourse['trainingEvent']);
    foreach($myCourse as $item){
        if($course!=$item){
            array_push($newMyCourse,$item);
        }
    }
    if(count($newMyCourse)==0){
        $myCourse2='';
    } else {
    $myCourse2 = implode(',',$newMyCourse);
    }
    updateEventPersonForDelete($link,$myCourse2,$people);
}

function updateEventPersonForDelete($link,$idCourse,$idPerson){
    $query = "UPDATE `student` SET `trainingEvent`='$idCourse' WHERE `id`='$idPerson'";
    if (mysqli_query($link, $query)) {
        return 1;
}}

// --------- Оплаты и посещения мероприятий

function writeVisitedEventPeople($link,$idPeople,$idCourse,$dateVisit){
    $getAllPeopleVisited = getAll($link, 'visitedEvent');
    foreach($getAllPeopleVisited as $people){
         if($people['idPeople']==$idPeople&&$people['idCourse']==$idCourse){
            $newVisited = $people['dateVisit'];
             $flag=1;
             break;
         } else {
            $flag=0;
         }
    }
    if ($flag==0){
        createVisitedEventPeople($link,$idPeople,$idCourse);
        writeVisitedEventPeopleNew($link,$idPeople,$idCourse,$dateVisit);
    } else {
        if($newVisited==''){
            $newVisited=$dateVisit;
            writeVisitedEventPeopleNew($link,$idPeople,$idCourse,$newVisited);
        } else {
            $dateVisitHistory = explode('|', $newVisited);
            foreach($dateVisitHistory as $key => $tag_name){
                if ($tag_name==$dateVisit){
                    $flagСoincidence=1;
                    unset($dateVisitHistory[$key]);
                    break;
                } else {
                    $flagСoincidence=0;
                }
            }
            if($flagСoincidence==0){
                $newVisited=$newVisited.'|'.$dateVisit;
                getLog($link, 'Ученику с id '.$idPeople.' добавили посещение '.$dateVisit.' в мероприятии с id '.$idCourse);
                writeVisitedEventPeopleNew($link,$idPeople,$idCourse,$newVisited);
            } else {
                $newVisited = implode('|', $dateVisitHistory);
                
                getLog($link, 'Ученику с id '.$idPeople.' удалили посещение '.$dateVisit.' в мероприятии с id '.$idCourse);
                writeVisitedEventPeopleNew($link,$idPeople,$idCourse,$newVisited);
            }
        }
        
    }
}
function createVisitedEventPeople($link,$idPeople,$idCourse){
    $query = "INSERT INTO `visitedEvent`(`idPeople`, `idCourse`,`dateVisit`) VALUES ('$idPeople','$idCourse','')";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}
function writeVisitedEventPeopleNew($link,$idPeople,$idCourse,$dateVisit){
    $query = "UPDATE `visitedEvent` SET `dateVisit`='$dateVisit'  WHERE `idPeople`='$idPeople' AND `idCourse`='$idCourse'";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}

function getOneVisitedFromIdPersonAndpdEvent($link, $idPeople,$idCourse)
{
    $query = sprintf("SELECT `id`, `idPeople`, `idCourse`, `dateVisit` FROM `visitedEvent` WHERE `idPeople`='$idPeople' AND `idCourse`='$idCourse'");
    $result = mysqli_query($link, $query);
    if (!$result)
        die(mysqli_error($link));
    $res = mysqli_fetch_assoc($result);
    return $res;
}

// ------

function writePayEventPeople($link,$idPeople,$idCourse,$datePay){
    $getAllPeoplePay = getAll($link, 'paymentEvent');
    foreach($getAllPeoplePay as $people){
         if($people['idPeople']==$idPeople&&$people['idCourse']==$idCourse){
            $newPay = $people['datePay'];
             $flag=1;
             break;
         } else {
            $flag=0;
         }
    }
    if ($flag==0){
        createPayEventPeople($link,$idPeople,$idCourse);
        writePayEventPeopleNew($link,$idPeople,$idCourse,$datePay);
    } else {
        if($newPay==''){
            $newPay=$datePay;
            writePayEventPeopleNew($link,$idPeople,$idCourse,$newPay);
        } else {
            $datePayHistory = explode('|', $newPay);
            foreach($datePayHistory as $key => $tag_name){
                if ($tag_name==$datePay){
                    $flagСoincidence=1;
                    unset($datePayHistory[$key]);
                    break;
                } else {
                    $flagСoincidence=0;
                }
            }
            if($flagСoincidence==0){
                $newPay=$newPay.'|'.$datePay;
                getLog($link, 'Ученику с id '.$idPeople.' добавили оплату '.$datePay.' в мероприятии с id '.$idCourse);
                writePayEventPeopleNew($link,$idPeople,$idCourse,$newPay);
            } else {
                $newPay = implode('|', $datePayHistory);
                
                getLog($link, 'Ученику с id '.$idPeople.' удалили оплату '.$datePay.' в мероприятии с id '.$idCourse);
                writePayEventPeopleNew($link,$idPeople,$idCourse,$newPay);
            }
        }
        
    }
}
function createPayEventPeople($link,$idPeople,$idCourse){
    $query = "INSERT INTO `paymentEvent`(`idPeople`, `idCourse`,`datePay`) VALUES ('$idPeople','$idCourse','')";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}
function writePayEventPeopleNew($link,$idPeople,$idCourse,$datePay){
    $query = "UPDATE `paymentEvent` SET `datePay`='$datePay'  WHERE `idPeople`='$idPeople' AND `idCourse`='$idCourse'";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}

function getOnePayFromIdPersonAndpdEvent($link, $idPeople,$idCourse)
{
    $query = sprintf("SELECT `id`, `idPeople`, `idCourse`, `datePay` FROM `paymentEvent` WHERE `idPeople`='$idPeople' AND `idCourse`='$idCourse'");
    $result = mysqli_query($link, $query);
    if (!$result)
        die(mysqli_error($link));
    $res = mysqli_fetch_assoc($result);
    return $res;
}

function updateEvetSettings($link,$id,$title,$startTime,$endTime,$countPeople,$minAge,$maxAge,$dateStart,$dateEnd,$price){
    $query = "UPDATE `event` SET `title`='$title',`startTime`='$startTime',`endTime`='$endTime',`countPeople`='$countPeople',`minAge`='$minAge',`maxAge`='$maxAge',`dateStart`='$dateStart',`dateEnd`='$dateEnd',`price`='$price' WHERE `id`='$id'";
    if (mysqli_query($link, $query)) {
        return 1;
}}

function deleteEventForId($link,$id){
    $query = "DELETE FROM `event` WHERE `id`='$id'";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}

function updateStatusEvent($link,$id,$status){
    if ($status==1){
        $newStatus = 0;
    } else {
        $newStatus = 1;
    }
    $query = "UPDATE `event` SET `status`='$newStatus' WHERE `id`='$id'";
    if (mysqli_query($link, $query)) {
        return 1;
}}

function updateCoursesSettings($link,$id,$title,$startTime,$endTime,$countPeople,$minAge,$maxAge,$dateStart,$dateEnd,$day){
    $query = "UPDATE `courses` SET `title`='$title',`startTime`='$startTime',`endTime`='$endTime',`howMany`='$countPeople',`minAge`='$minAge',`maxAge`='$maxAge',`dateStart`='$dateStart',`dateEnd`='$dateEnd',`day`='$day' WHERE `id`='$id'";
    if (mysqli_query($link, $query)) {
        return 1;
}}

function deleteCoursesForId($link,$id){
    $query = "DELETE FROM `courses` WHERE `id`='$id'";
    if (mysqli_query($link, $query)) {
        return 1;
    }
}

function updateStatusCourses($link,$id,$status){
    if ($status==1){
        $newStatus = 0;
    } else {
        $newStatus = 1;
    }
    $query = "UPDATE `courses` SET `status`='$newStatus' WHERE `id`='$id'";
    if (mysqli_query($link, $query)) {
        return 1;
}}

