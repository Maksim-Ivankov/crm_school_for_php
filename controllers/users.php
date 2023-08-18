<?php session_start();
include $_SERVER['DOCUMENT_ROOT']."/models/model.php";
if (isset($_POST['login'])){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $users = getAll($link, 'users');
    foreach ($users as $items){
        if($items['login']==$login && $items['password']==$password){
            $flag=1;
            break;
        } 
        $flag=0;
    }
    if ($flag==1){
        $userAuth = getOneUser($link, $login);
        $_SESSION['login'] = $userAuth['login'];
        $_SESSION['role'] = $userAuth['role'];
        $_SESSION['name'] = $userAuth['name'];
        $_SESSION['sername'] = $userAuth['sername'];
        $_SESSION['photo'] = $userAuth['photo'];
        $_SESSION['dateReg'] = $userAuth['dateReg'];
        getLog($link, 'Пользователь '.$login.' вошел в систему');
        header('Location: /public/home.php');
        
    } else {
        getLog($link, 'Неправильный пароль входа в систему у '.$login);
        echo 'Нет';
    }
}

if(isset($_GET['logOut'])){
    unset($_SESSION['login']);
    session_destroy();
    getLog($link, 'Пользователь вышел из системы');
    header('Location: /index.php');
}

if (isset($_GET['newPerson'])){
    $name=$_GET['name'];
    $serName=$_GET['serName'];
    $old=$_GET['old'];
    $telephone=$_GET['telephone'];
    $curse=$_GET['curse'];
    $start=$_GET['start'];
    $comment=$_GET['comment'];
    $dateTrial=$_GET['dateTrial'];
    $namePerent=$_GET['namePerent'];
    $status=$_GET['status'];
    if(setNewPerson($link,$name,$serName,$old,$telephone,$curse,$start,$comment,$dateTrial,$namePerent,$status)){
        getLog($link, 'Добавили нового ученика: '.$name.' '.$serName.' '.$telephone);
        echo '1';
    } else {
        getLog($link, 'Ошибка добавления ученика: '.$name.' '.$serName.' '.$telephone);
        echo '0';
    }
}
if (isset($_GET['title'])){
    $title=$_GET['title'];
    $day=$_GET['day'];
    $startTime=$_GET['startTime'];
    $endTime=$_GET['endTime'];
    $howMany=$_GET['howMany'];
    $minAge=$_GET['minAge'];
    $maxAge=$_GET['maxAge'];
    $dateStart=$_GET['dateStart'];
    $dateEnd=$_GET['dateEnd'];
    if(setNewCourses($link,$title,$day,$startTime,$endTime,$howMany,$minAge,$maxAge,$dateStart,$dateEnd)){
        getLog($link, 'Добавили новый курс: '.$title.' '.$day.' '.$startTime.' '.$endTime);
        echo '1';
    } else {
        echo '0';
    }
}
if (isset($_GET['selectCourse'])){
    $course = $_GET['idCourse'];
    $people = $_GET['idPerson'];
    if(updateCoursePerson($link,$course,$people)){
        getLog($link, 'Для ученика с id '.$people.' установили курс с id '.$course);
        echo '1';
    } else {
        echo '0';
    }

}
if (isset($_GET['deleteCourse'])){
    $course = $_GET['idCourse'];
    $people = $_GET['idPerson'];
    deleteCoursePerson($link,$course,$people);
    getLog($link, 'У ученика с id '.$people.' удалили курс с id '.$course);
        echo '1';
}
if (isset($_GET['saveProfilePerson'])){
    
    $id=$_GET['id'];
    $name=$_GET['name'];
    $serName=$_GET['serName'];
    $old=$_GET['old'];
    $telephone=$_GET['telephone'];
    $curse=$_GET['curse'];
    $start=$_GET['start'];
    $comment=$_GET['comment'];
    $dateTrial=$_GET['dateTrial'];
    $namePerent=$_GET['namePerent'];
    $status=$_GET['status'];
    if(updateProfilePerson($link,$id,$name,$serName,$old,$telephone,$curse,$start,$comment,$dateTrial,$namePerent,$status)){
        getLog($link, 'У ученика с id '.$id.' изменили профиль');
        echo '1';
    } else {
        echo '0';
    }
}
if (isset($_GET['visit'])){
    $mode = $_GET['mode'];
    $idPeople = $_GET['id'];
    $dateVisit = $_GET['dateCurse'];
    $idCourse = $_GET['idCourse'];
    if ($mode=='1'){
        writeVisitedCoursePeople($link,$idPeople,$idCourse,$dateVisit);
        echo '1';
    } else {
        writePayCoursePeople($link,$idPeople,$idCourse,$dateVisit);
        echo '1';   
    }   
}

if (isset($_GET['newPay'])){
    $idStudent = $_GET['idStudent'];
    $datePay = $_GET['datePay'];
    $pricePay = $_GET['pricePay'];
    $commentPay = $_GET['commentPay'];
    getNewPay($link, $idStudent,$datePay,$pricePay,$commentPay);
    getLog($link, 'Добавили новую оплату у id '.$idStudent.' сумма '.$pricePay);
    echo '1';

}
if (isset($_GET['PayСhange'])){
    $idOperation = $_GET['idOperation'];
    $datePay = $_GET['datePay'];
    $pricePay = $_GET['pricePay'];
    $commentPay = $_GET['commentPay'];
    $idStudent = $_GET['idStudent'];
    updatePayChange($link,$idOperation,$datePay,$pricePay,$commentPay,$idStudent);
    getLog($link, 'Изменили данные оплаты с id '.$idOperation);
    echo '1';

}
if (isset($_GET['setPayСhangeDelete'])){
    $idOperation = $_GET['idOperation'];
    $datePay = $_GET['datePay'];
    $pricePay = $_GET['pricePay'];
    $commentPay = $_GET['commentPay'];
    $idStudent = $_GET['idStudent'];
    deletePayOperation($link,$idOperation);
    getLog($link, 'Удалена оплата с id '.$idOperation.', дата '.$datePay.', оплата '.$pricePay.', комментарий '.$commentPay.', id ученика '.$idStudent);
    echo '1';
}
if (isset($_GET['newCost'])){
    $date = $_GET['date'];
    $price = $_GET['price'];
    $comment = $_GET['comment'];
    getNewCost($link, $date,$price,$comment);
    getLog($link, 'Добавлен новый расход '.$date.' '.$price.' '.$comment);
    echo '1';
}
if (isset($_GET['CostСhange'])){
    $idCost = $_GET['idCost'];
    $dateCost = $_GET['dateCost'];
    $priceCost = $_GET['priceCost'];
    $commentCost = $_GET['commentCost'];
    updateCostChange($link,$idCost,$dateCost,$priceCost,$commentCost);
    getLog($link, 'Расход с id '.$idCost.' был изменён '.$dateCost.' '.$priceCost.' '.$commentCost);
    echo '1';
}
if (isset($_GET['CostDelete'])){
    $idCost = $_GET['idCost'];
    $dateCost = $_GET['dateCost'];
    $priceCost = $_GET['priceCost'];
    $commentCost = $_GET['commentCost'];
    costDelete($link,$idCost);
    getLog($link, 'Расход с id '.$idCost.' был удалён '.$dateCost.' '.$priceCost.' '.$commentCost);
    echo '1';
}
if (isset($_GET['newEvent'])){
    $titleEvent = $_GET['titleEvent'];
    $day = $_GET['day'];
    $startTimeEvent = $_GET['startTimeEvent'];
    $endTimeEvent = $_GET['endTimeEvent'];
    $countPeople = $_GET['countPeople'];
    $minAge = $_GET['minAge'];
    $maxAge = $_GET['maxAge'];
    $dateStart = $_GET['dateStart'];
    $dateEnd = $_GET['dateEnd'];
    $price = $_GET['price'];
    newEvent($link, $titleEvent,$day,$startTimeEvent,$endTimeEvent,$countPeople,$minAge,$maxAge,$dateStart,$dateEnd,$price);
    getLog($link, 'Добавлено новое мероприятие '.$titleEvent);
    echo '1';
}

if (isset($_GET['selectEvent'])){
    $event = $_GET['idEvent'];
    $people = $_GET['idPerson'];
    if(updateEventPerson($link,$event,$people)){
        getLog($link, 'Для ученика с id '.$people.' установили мероприятие с id '.$event);
        echo '1';
    } else {
        echo '0';
    }

}

if (isset($_GET['deleteEvent'])){
    $event = $_GET['idCourse'];
    $people = $_GET['idPerson'];
    deleteEventPerson($link,$event,$people);
    getLog($link, 'У ученика с id '.$people.' удалили мероприятие с id '.$event);
        echo '1';
}

if (isset($_GET['eventForJournal'])){
    $mode = $_GET['mode'];
    $idPeople = $_GET['id'];
    $dateVisit = $_GET['dateCurse'];
    $idCourse = $_GET['idCourse'];
    if ($mode=='1'){
        writeVisitedEventPeople($link,$idPeople,$idCourse,$dateVisit);
        echo '1';
    } else {
        writePayEventPeople($link,$idPeople,$idCourse,$dateVisit);
        echo '1';   
    }   
}

if (isset($_GET['editEventSettings'])){
    $id = $_GET['id'];
    $title = $_GET['title'];
    $startTime = $_GET['startTime'];
    $endTime = $_GET['endTime'];
    $countPeople = $_GET['countPeople'];
    $minAge = $_GET['minAge'];
    $maxAge = $_GET['maxAge'];
    $dateStart = $_GET['dateStart'];
    $dateEnd = $_GET['dateEnd'];
    $price = $_GET['Price'];
    updateEvetSettings($link,$id,$title,$startTime,$endTime,$countPeople,$minAge,$maxAge,$dateStart,$dateEnd,$price);
    getLog($link, 'Изменили мероприятие с id '.$id);
        echo '1';
}
if (isset($_GET['editEventSettingsDelete'])){
    $id = $_GET['id'];
    deleteEventForId($link,$id);
    getLog($link, 'Удалили мероприятие мероприятие с id '.$id);
        echo '1';
}
if (isset($_GET['updateStatusEvent'])){
    $id = $_GET['id'];
    $status = $_GET['status'];
    updateStatusEvent($link,$id,$status);
    getLog($link, 'Изменили статус мероприятия с id '.$id);
        echo '1';
}

if (isset($_GET['editCoursesSettings'])){
    $id = $_GET['id'];
    $title = $_GET['title'];
    $day = $_GET['day'];
    $startTime = $_GET['startTime'];
    $endTime = $_GET['endTime'];
    $countPeople = $_GET['countPeople'];
    $minAge = $_GET['minAge'];
    $maxAge = $_GET['maxAge'];
    $dateStart = $_GET['dateStart'];
    $dateEnd = $_GET['dateEnd'];
    updateCoursesSettings($link,$id,$title,$startTime,$endTime,$countPeople,$minAge,$maxAge,$dateStart,$dateEnd,$day);
    getLog($link, 'Изменили курс с id '.$id);
        echo '1';
}

if (isset($_GET['editCoursesSettingsDelete'])){
    $id = $_GET['id'];
    deleteCoursesForId($link,$id);
    getLog($link, 'Удалили курс мероприятие с id '.$id);
        echo '1';
}

if (isset($_GET['updateStatusCourse'])){
    $id = $_GET['id'];
    $status = $_GET['status'];
    updateStatusCourses($link,$id,$status);
    getLog($link, 'Изменили статус курса с id '.$id);
        echo '1';
}