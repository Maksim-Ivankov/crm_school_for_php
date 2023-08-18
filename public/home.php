<?php include $_SERVER['DOCUMENT_ROOT'] . ("/templates/header.php"); ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . ("/templates/nav.php"); ?>


<?
        $arrOurVisitDay = array(); // - массив (объект), в который в будущем запишем дата = кол-во учеников по журналу в эту дату
        //записываем в массив arrCourses все id курсов
        $ourCursesStata = getAll($link, 'courses');
        $arrCourses = array();
        $arrVisit = array();
        foreach ($ourCursesStata as $ourCursesStataItem) {
            array_push($arrCourses, $ourCursesStataItem['id']);
        }
        //записываем в массив(объект) arrVisit id курса = кол-во учеников
        $getOurPeopleCurse = getAll($link, 'student');
        foreach ($arrCourses as $arrCoursesItem) {
            $countStudent = 0;
            foreach ($getOurPeopleCurse as $people) {
                $trainingGroup = $people['trainingGroup'];
                if ($trainingGroup != '0' || $trainingGroup != '') {
                    $myCourse = explode(',', $trainingGroup);
                    foreach ($myCourse as $myCourses) {
                        if ($myCourses == $arrCoursesItem) {
                            $countStudent++;
                        }
                    }
                }
            }

            $arrVisit[$arrCoursesItem] = $countStudent;
        }

?>
<div class="rightMainWrap">

    <div class="homeVisitChart">
        <p class="homeVisitChartTitleP">Посещение</p>
        <?
        $ourCurses = getAll($link, 'courses');
        $ourDate = array();
        $ourVisitsRoboCore = array();
        $getAllVisited = getAll($link, 'visited');
        foreach ($getAllVisited as $getAllVisitedItem) {
            $oneVisitsPeople = explode('|', $getAllVisitedItem['dateVisit']);
            foreach ($oneVisitsPeople as $oneVisitsPeopleItem) {
                array_push($ourVisitsRoboCore, $oneVisitsPeopleItem);
            }
        }
        $repetitions = array_count_values($ourVisitsRoboCore);
        function getDateForSpecificDayBetweenDates($startDate, $endDate, $day_number)
        {
            $endDate = strtotime($endDate);
            $days = array('1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', '4' => 'Thursday', '5' => 'Friday', '6' => 'Saturday', '7' => 'Sunday');
            for ($i = strtotime($days[$day_number], strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
                $date_array[] = date('Y-m-d', $i);

            return $date_array;
        }
        foreach ($ourCurses as $item) {
            $dateStart = $item['dateStart'];
            $day = $item['day'];
            $finalDatex = $item['dateEnd'];
            foreach (getDateForSpecificDayBetweenDates($dateStart, $finalDatex, $day) as $item) {
                $timestamp = strtotime($item);
                array_push($ourDate, $item);

            }
        }
        $ourDateCleen = array_unique($ourDate);
        usort($ourDateCleen, function ($a, $b) {
            return strtotime($a) - strtotime($b);
        });
        ?>
        <div class="ourDayFlex">
            <? //циклом ниже заполняется масссив arrOurVisitDay, дата = макс посещение в эту дату
            foreach ($ourDateCleen as $ourDateItem) {
                $countDayVisit = 0;
                $myDateTime = DateTime::createFromFormat('Y-m-d', $ourDateItem);
                $dateFormated = $myDateTime->format('d.m');
                $weekDay = date("w", strtotime($ourDateItem));
                foreach ($ourCursesStata as $ourCursesStataItem) {
                    if ($ourCursesStataItem['day'] == $weekDay) {
                        foreach ($arrVisit as $key => $value) {
                            if ($ourCursesStataItem['id'] == $key) {
                                $countDayVisit = $countDayVisit + $value;
                            }
                        }
    
                    }
                    $arrOurVisitDay[$dateFormated] = $countDayVisit;
    
                }
            }

            $procentVisitSum=0;
            $countVisitSum = 0;
            foreach ($ourDateCleen as $ourDateItem) {
                $myDateTime = DateTime::createFromFormat('Y-m-d', $ourDateItem);
                $dateFormated = $myDateTime->format('d.m');
                
                foreach ($repetitions as $key => $values) {
                    
                    if ($dateFormated == $key) {
                        $sizeVisited = $values;
                        $flagYesDate = 1;
                        ?>
                        <div class="ourDayFlexOneDay">
                            
                            <div class="ourDayFlexElement">
                                <?= substr($ourDateItem, 5); ?>
                            </div>
                            <div class="sizeVisitedBlock" style='height:<?= $sizeVisited * 2; ?>px;' title="<?= $sizeVisited ?>">
                            </div>
                            <div class="ourDayStataFlexElement">
                                    <?=round(($sizeVisited/$arrOurVisitDay[$key])*100).' %'?>
                            </div>
                        </div>
                        <?
                        $procentVisitSum = $procentVisitSum + round(($sizeVisited/$arrOurVisitDay[$key])*100);
                        $countVisitSum = $countVisitSum + 1;
                        break;
                    } else {
                        $flagYesDate = 0;
                    }
                    
                }
                if ($flagYesDate == 0) {
                    ?>
                    <div class="ourDayFlexOneDay">
                        <div class="ourDayFlexElement">
                            <?= substr($ourDateItem, 5); ?>
                        </div>
                    </div>
                <?
                }
            }
            
            ?>
<?
        
        
        
        
        // $arrVisit - массив, в котором по очереди лежит кол-во людей в группах
        // $arrCourses - массив, по очереди лежат id групп
        // $ourDateCleen - массив, даты всех групп неотформатированные
        // $dateFormated - внтури foreach переменная, отформатированная дата d.m
        // $weekDay - текущий номер дня недели
        // $repetitions - ключ - дата, значение - посещение
        

        ?>
        </div>
    </div>
    <!-- $procentVisitSum = $procentVisitSum + round(($sizeVisited/$arrOurVisitDay[$key])*100);
                        $countVisitSum = $countVisitSum + 1; -->
                        
    <div>
        <div class="pie" style="--p:40;--c:darkblue;--b:10px"> <?=round($procentVisitSum/$countVisitSum).' %'?></div>
        <p>Процент посещения</p>
        

    </div>
    <div>
        <div class="pie" style="--p:63;--c:darkblue;--b:10px"> 63%</div>
        <p>Робототехники</p>
    </div>
    <div>
        <div class="pie" style="--p:63;--c:darkblue;--b:10px"> 26%</div>
        <p>Программисты</p>
    </div>

    <div class="homeDasbordElement homeDasbordElementVisitForMounth">
        <p class="homeDasbordElementTitle">Посещение по месяцам</p>
        <div class="visitForMounthFlex">
            <?
            $mounth = array('1' => 'Январь', '2' => 'Февраль', '3' => 'Март', '4' => 'Апрель', '5' => 'Май', '6' => 'Июнь', '7' => 'Июль', '8' => 'Август', '9' => 'Сентябрь', '10' => 'Октябрь', '11' => 'Ноябрь', '12' => 'Декабрь');
            $ourVisitsRoboCoreHome = array();
            $getAllVisited = getAll($link, 'visited');
            foreach ($mounth as $key => $ValueMounthItem) {
                $countVisit = 0;
                $dateMouth = setDateMounth($key);
                foreach ($getAllVisited as $getAllVisitedItem) {
                    $oneVisitsPeople = explode('|', $getAllVisitedItem['dateVisit']);
                    foreach ($oneVisitsPeople as $oneVisitsPeopleItem) {
                        array_push($ourVisitsRoboCoreHome, $oneVisitsPeopleItem);
                    }
                }
                $countVisit = 0;
                foreach ($repetitions as $key => $values) {
                    foreach ($dateMouth as $dateMouthItem) {
                        if ($dateMouthItem == $key) {
                            $countVisit = $values + $countVisit;
                        }
                    }
                } ?>
                <div class="visitForMounthElementFlex">
                    <p class="visitForMounthElementFlexMounthP">
                        <?= $ValueMounthItem ?>
                    </p>
                    <p class="visitForMounthElementFlexCountP">
                        <?= $countVisit ?>
                    </p>
                </div>
            <? } ?>
        </div>
    </div>
    <div>
        <p>Средний чек</p>
    </div>
    <div>
        <p>Выручка по месяцам</p>
    </div>
    <div>
        <p>Выручка в сентябре</p>
    </div>
    <div>
        <p>Расходы по месяцам</p>
    </div>
    <div>
        <p>Расходы в сентябре</p>
    </div>
    <div>
        <p>Проведено занятий</p>
    </div>
    <div>
        <p>Занятий, часов</p>
    </div>
    <div>
        <p>Возраст диаграмма</p>
    </div>





</div>
</div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . ("/templates/footer.php"); ?>