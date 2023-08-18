<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/header.php"); ?>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/nav.php"); ?>
        <div class="rightMainWrap">
            
            <?
            $ourCurses = getAll($link, 'student');
            foreach($ourCurses as $item){
              if($_GET['id']==$item['id']){
                $name = $item['name'];
                $sername = $item['sername'];
                $old = $item['old'];
                $telephone = $item['telephone'];
                $curse = $item['curse'];
                $start = $item['start'];
                $comment = $item['comment'];
                $dateTrial = $item['dateTrial'];
                $namePerent = $item['namePerent'];
                $status = $item['status'];
                $idStudent = $item['id'];
                $trainingGroup = $item['trainingGroup'];
                $trainingEvent = $item['trainingEvent'];
              }
            }
            ?>
            <div class="cardStudentWrapFlex">
            <div class="newPersonWrapCardPerson">
                <div class="newPersonWrapLeft">
                <p class="idStudentCardStudent" style="display:none;"> <?= $idStudent; ?> </p>
                    <p class="labelNewPerson"> Имя ученика </p>
                    <p class="labelNewPerson"> Фамилия ученика</p>
                    <p class="labelNewPerson"> Возраст</p>
                    <p class="labelNewPerson"> Имя родителя</p>
                    <p class="labelNewPerson"> Телефон родителя</p>
                    <p class="labelNewPerson"> Дата пробного</p>
                    <p class="labelNewPerson"> Начало обучения</p>
                    <p class="labelNewPerson"> Статус</p>
                    <p class="labelNewPerson"> Курс</p>
                    <p class="labelNewPerson"> Комментарии</p>
                    
                </div>
                <div class="newPersonWrapRight">
                    <input type="text" value="<?=$name;?>" class="inputNewPerson inputNewPersonSaveName">
                    <input type="text" value="<?=$sername;?>" class="inputNewPerson inputNewPersonSaveSername">
                    <input type="text" value="<?=$old;?>" class="inputNewPerson inputNewPersonSaveOld">
                    <input type="text" value="<?=$namePerent;?>" class="inputNewPerson inputNewPersonSaveNameParent">
                    <input type="text" value="<?=$telephone;?>" class="inputNewPerson inputNewPersonSaveTelephone">
                    <input type="date" value="<?=$dateTrial;?>" class="inputNewPerson inputNewPersonSaveDateTrial">
                    <input type="date" value="<?=$start;?>" class="inputNewPerson inputNewPersonSaveStart">
                    <select id="statusPerson" class="inputNewPersonStatus">
                        <option value="1" <? if($status=='1'){echo 'selected';} ?>>Обучается</option>
                        <option value="2" <? if($status=='2'){echo 'selected';} ?>>Перерыв</option>
                        <option value="3" <? if($status=='3'){echo 'selected';} ?>>Перестали ходить</option> 
                        <option value="4" <? if($status=='4'){echo 'selected';} ?>>Уехали</option> 
                    </select>
                    <select id="cursePerson" class="inputNewPersonCurse">
                        <option value="1" <? if($curse=='1'){echo 'selected';} ?>>Робототехника</option>
                        <option value="2" <? if($curse=='2'){echo 'selected';}?>>Программирование</option>
                        <option value="3" <? if($curse=='3'){echo 'selected';}?>>Рт и прог</option> 
                        <option value="4" <? if($curse=='4'){echo 'selected';}?>>Репетиторство</option> 
                        <option value="5" <? if($curse=='5'){echo 'selected';}?>>Две робототехники</option> 
                         
                    </select>
                    <input type="text" value="<?=$comment;?>" class="inputNewPerson inputNewPersonSaveComment">
                    
                </div>
                <div class="newPersonWrapGroupRight">
                <p class="newPersonWrapTitleGroub">Текущие группы и мероприятия</p>
                <p class="newPersonWrapTitleGroubP"><? if($trainingGroup=='0'&&$trainingEvent==''){
                    echo '&nbsp;Нет группы';
                } else {
                    $myCourse = explode(',', $trainingGroup);
                    $myEvent = explode(',', $trainingEvent);
                    foreach($myCourse as $item){
                        $getCourse = getAll($link, 'courses');
                        foreach($getCourse as $course){
                            if ($item==$course['id']){
                                ?>  <div>

                                    </div>
                                    <a class="selectCoursePersonBtn" alt="<?=$course['id']?>" onclick="deleteCoursePerson(this)">
                                    <div class="newPersonWrapMyCourse">
                                        <span><?=$course['title']?></span>
                                        <span><?= $days[$course['day']-1] ?></span>
                                        <span><?=$course['startTime']?>:00 - <?=$course['endTime']?>:00</span>
                                        <span><?=$course['minAge']?>-<?=$course['maxAge']?> лет</span>
                                        
                                    </div>
                                    </a>
                                <?
                            }
                        }
                    }
                
                    foreach($myEvent as $item){
                        $getEvent = getAll($link, 'event');
                        foreach($getEvent as $course){
                            if ($item==$course['id']){

                                ?>  <a class="selectCoursePersonBtn" alt="<?=$course['id']?>" onclick="deleteEventPerson(this)">
                                <div class="newPersonWrapMyCourse">
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
                                    </a>
                                <?
                            }
                        }
                    }
                }
                
               
                ?></p>
                <div class="newPersonWrapTitleGroubBorderDiv"></div>
                <p class="newPersonWrapTitleGroub newPersonWrapTitleGroubTwo">Записать в группу</p>
                <? $ourCurses = getAll($link, 'courses');
                $days = array( "Понедельник" , "Вторник" , "Среда" , "Четверг" , "Пятница" , "Суббота" , "Воскресенье" );
                      foreach($ourCurses as $item){
                        if($item['status']==1){
                        ?>
                        <a class="selectCoursePersonBtn" alt="<?=$item['id']?>" onclick="selectCoursePerson(this)"><div class="newPersonWrapTitleGroubBorderDivElement">
                            <span><?=$item['title']?></span>
                            <span><?= $days[$item['day']-1] ?></span>
                            <span><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</span>
                            <span><?=$item['minAge']?>-<?=$item['maxAge']?> лет</span>
                        </div></a>
                        <?
                      }}?>
                <div class="newPersonWrapTitleGroubBorderDiv"></div>
                <p class="newPersonWrapTitleGroub newPersonWrapTitleGroubTwo">Записать на мероприятие</p>
                <? $ourCurses = getAll($link, 'event');
                      foreach($ourCurses as $item){
                        if($item['status']==1){
                        ?>
                        <a class="selectCoursePersonBtn" alt="<?=$item['id']?>" onclick="selectEventPerson(this)"><div class="newPersonWrapTitleGroubBorderDivElement">
                            <span><?=$item['title']?></span>
                            <span><?
                            if ($item['dateStart']==$item['dateEnd']){
                                echo date('d.m.Y', strtotime($item['dateStart']));
                            } else {
                                echo date('d.m.Y', strtotime($item['dateStart'])).' - '.date('d.m.Y', strtotime($item['dateEnd']));
                            }
                            ?></span>
                            <span><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</span>
                        </div></a>
                        <?
                      }}?>
            </div>
                
                <a class="buttonNewPerson" onclick="saveProfilePeople()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Сохранить</a>
            </div>

        </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/footer.php"); ?>