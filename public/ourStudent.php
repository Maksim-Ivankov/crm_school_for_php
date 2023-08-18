<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/header.php"); ?>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/nav.php"); ?>
        <div class="rightMainWrap">
            <div class="sortOurStudentNav">
                <input id='myInput' onkeyup='searchTable()' type='text' class="searchSortOurStudentNav" placeholder="Введите для поиска">
            </div>
            <table class="ourStudentTable" id='myTable'>
                <tr class="ourStudentTableTr ourStudentTableTrTitle">
                    <td class="ourStudentTableTd ourStudentTableTdTitle">№</td>
                    <td class="ourStudentTableTd ourStudentTableTdTitle">Имя</td>
                    <td class="ourStudentTableTd ourStudentTableTdTitle">Фамилия</td>
                    <td class="ourStudentTableTd ourStudentTableTdTitle">Возраст</td>
                    <td class="ourStudentTableTd ourStudentTableTdTitle">Имя родителя</td>
                    <td class="ourStudentTableTd ourStudentTableTdTitle">Телефон родителя</td>
                    <td class="ourStudentTableTd ourStudentTableTdTitle">Группа</td>
                    <td class="ourStudentTableTd ourStudentTableTdTitle">Дата пробного</td>
                    <td class="ourStudentTableTd ourStudentTableTdTitle">Начало обучения</td>
                    <td class="ourStudentTableTd ourStudentTableTdTitle">Курс</td>
                    <td class="ourStudentTableTd ourStudentTableTdTitle">Статус</td>
                    <td class="ourStudentTableTd ourStudentTableTdTitle">Комментарии</td>
                </tr>
                <?
                    $ourPerson = getAll($link, 'student');
                    $count=0;
                    foreach($ourPerson as $item){
                        
                        ?>
                            <tr class="ourStudentTableTr ourStudentTableTrPeople" alt="" onclick="openCardPeople(<?=$item['id']?>)">
                                <td class="ourStudentTableTd"><?= ++$count;?></td>
                                <td class="ourStudentTableTd"><?= $item['name']; ?></td>
                                <td class="ourStudentTableTd"><?= $item['sername']; ?></td>
                                <td class="ourStudentTableTd"><?= $item['old']; ?></td>
                                <td class="ourStudentTableTd"><?= $item['namePerent']; ?></td>
                                <td class="ourStudentTableTd"><?= $item['telephone']; ?></td>
                                <td class="ourStudentTableTd">

                                <?
                                    $trainingGroup = $item['trainingGroup'];
                                    $trainingEvent = $item['trainingEvent'];
                                     if($trainingGroup=='0'&&$trainingEvent==''){
                                        echo '&nbsp;Нет группы';
                                    } else {
                                        $myCourse = explode(',', $trainingGroup);
                                        $myEvent = explode(',', $trainingEvent);
                                        foreach($myCourse as $myCourses){
                                            $getCourse = getAll($link, 'courses');
                                            foreach($getCourse as $course){
                                                if ($myCourses==$course['id']){
                                                    ?>  
                                                        <div class="newPersonWrapMyCourse22">
                                                            <span><?=$course['title']?></span>
                                                            <span><?= $days[$course['day']-1] ?></span>
                                                            <span><?=$course['startTime']?>:00 - <?=$course['endTime']?>:00</span>
                                                            <span><?=$course['minAge']?>-<?=$course['maxAge']?> лет</span>
                                                            
                                                        </div>
                                                        
                                                    <?
                                                }
                                            }
                                        }
                                        foreach($myEvent as $item22){
                                            $getEvent = getAll($link, 'event');
                                            foreach($getEvent as $course){
                                                if ($item22==$course['id']){
                    
                                                    ?> 
                                                    <div class="newPersonWrapMyCourse22">
                                                    <span><?=$course['title']?></span>
                                                    <span><?
                                                    if ($course['dateStart']==$course['dateEnd']){
                                                        echo date('d.m.Y', strtotime($course['dateStart']));
                                                    } else {
                                                        echo date('d.m.Y', strtotime($course['dateStart'])).' - '.date('d.m.Y', strtotime($course['dateEnd']));
                                                    }
                                                    ?></span>
                                                    <span><?=$course['startTime']?>:00 - <?=$course['endTime']?>:00</span>
                                                    
                                                </div>
                                                        
                                                    <?
                                                }
                                            }
                                        }
                                    }
                                ?>


                                </td>
                                <td class="ourStudentTableTd"><?= $item['dateTrial']; ?></td>
                                <td class="ourStudentTableTd"><?= $item['start']; ?></td>
                                <td class="ourStudentTableTd"><? if($item['curse']==1){
                                    echo 'Робототехника';
                                } if($item['curse']==2){
                                    echo 'Программирование';
                                } if($item['curse']==3){
                                    echo 'Рт и прог';
                                } if($item['curse']==4){
                                    echo 'Репетиторство';
                                } if($item['curse']==5){
                                    echo 'Две робототехники';
                                } 
                                ?></td>
                                <td class="ourStudentTableTd"><? if($item['status']==1){
                                    echo 'Обучается';
                                } if($item['status']==2){
                                    echo 'Перерыв';
                                } if($item['status']==3){
                                    echo 'Перестали ходить';
                                } if($item['status']==4){
                                    echo 'уехали';
                                } 
                                ?></td>
                                <td class="ourStudentTableTd"><?= $item['comment']; ?></td>
                                
                                </tr>
                        <?
                    }
                ?>
            </table>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/footer.php"); ?>