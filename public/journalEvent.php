<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/header.php"); ?>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/nav.php"); ?>
    <div class="rightMainWrap">
        <div class="journalCourseWrapper">
            <p class="idCurseJurnalCourse" style="display:none;"><?=$_GET['event']?></p>
            <?
                $ourEvent = getAll($link, 'event');
                      foreach($ourEvent as $item){
                        if($_GET['event']==$item['id']){
                            $dateStart = $item['dateStart'];
                            $finalDatex = $item['dateEnd'];
                            break;
                        }}
                        
                        // function getDateForSpecificDayBetweenDates($startDate,$endDate,$day_number){
                        //     $endDate = strtotime($endDate);
                        //     $days=array('1'=>'Monday','2' => 'Tuesday','3' => 'Wednesday','4'=>'Thursday','5' =>'Friday','6' => 'Saturday','7'=>'Sunday');
                        //     for($i = strtotime($days[$day_number], strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
                        //     $date_array[]=date('Y-m-d',$i);
                            
                        //     return $date_array; 
                        //      }
                        // ----------- get_dates($dateStart, $finalDatex, $format = 'Y-m-d')
                            ?>
                            <div class="modeInputFlex">
                                <p  class="modeInputClassP">Режим ввода </p>
                                <select id="modeInput" class="modeInputClassSelect">
                                    <option value="1" <? if($_GET['mode']==1){?>selected="selected"<?}?>>Посещение</option>
                                    <option value="2" <? if($_GET['mode']==2){?>selected="selected"<?}?>>Оплата</option>
                                     
                                </select>
                            </div>
                                <div class="journalCourseTableWrapper">
                                    <div class="journalCourseTableWrapperHeader">
                                    <div class="journalCourseTableWrapperHeaderMounth">
                                            <div class="journalCourseTableWrapperHeaderMounthName">
                                                Месяц
                                            </div>
                                            <div class="journalCourseTableWrapperHeaderMounthFlexDay">
                                                Число
                                            </div>
                                            <?
                                    $getOurPeopleCurse = getAll($link, 'student');
                                    foreach($getOurPeopleCurse as $people){
                                        $trainingEvent = $people['trainingEvent'];
                                        if($trainingEvent!=''){
                                            $myCourse = explode(',', $trainingEvent);
                                            foreach($myCourse as $myCourses){
                                                if($myCourses==$_GET['event']){
                                                    ?>
                                                        <div  class="journalCourseTableWrapperHeaderMounthFlexDayPeople">
                                                            <?=$people['name']?>&nbsp;<?=$people['sername']?>
                                                        </div>
                                                    <?
                                                }
                                            }
                                        }
                                    }
                                    
                                ?>
                                        </div>
                                        
                                        <? foreach(get_dates($dateStart, $finalDatex, $format = 'Y-m-d') as $item){
                                            $timestamp = strtotime($item);
                                            $onlyDay = date('d', $timestamp);
                                            $onlyMonth = date('m', $timestamp); ?>
                                        <div class="journalCourseTableWrapperHeaderMounth">
                                            <div class="journalCourseTableWrapperHeaderMounthName">
                                                <?= $onlyMonth; ?>
                                            </div>
                                            <div class="journalCourseTableWrapperHeaderMounthFlexDay">
                                                <?= $onlyDay; ?>
                                            </div>


                                            <?
                                    $getOurPeopleCurse = getAll($link, 'student');
                                    foreach($getOurPeopleCurse as $people){
                                        $trainingEvent = $people['trainingEvent'];
                                        if($trainingEvent!=''){
                                            $myCourse = explode(',', $trainingEvent);
                                            foreach($myCourse as $myCourses){
                                                if($myCourses==$_GET['event']){
                                                    ?>
                                                        <a alt="<?= $onlyDay.'.'.$onlyMonth; ?>" onclick="setDayBePeopleEvent(this)">
                                                        <div  class="journalCourseTableDayPeople" title="<?=$people['id']?>"
                                                        
                                                        <?
                                                                
                                                                $getAllPeoplePay = getOnePayFromIdPersonAndpdEvent($link, $people['id'],$_GET['event']);
                                                                $datePayHistory = explode('|', $getAllPeoplePay['datePay']);
                                                                foreach($datePayHistory as $datePayHistoryItem){
                                                                    if($datePayHistoryItem==$onlyDay.'.'.$onlyMonth){
                                                                        ?>style="background-color: #a6de76;"<? break;
                                                                    }
                                                                }
                                                            ?>>
                                                            <?
                                                                
                                                                $getAllPeopleVisited = getOneVisitedFromIdPersonAndpdEvent($link, $people['id'],$_GET['event']);
                                                                $dateVisitHistory = explode('|', $getAllPeopleVisited['dateVisit']);
                                                                foreach($dateVisitHistory as $dateVisitHistoryItem){
                                                                    if($dateVisitHistoryItem==$onlyDay.'.'.$onlyMonth){
                                                                        ?><p class="journalCourseTableDayPeopleX">x</p><? break;
                                                                    } else {

                                                                    }
                                                                }
                                                            ?>
                                                        </div></a>
                                                    <?
                                                }
                                            }
                                        }
                                    }
                                    
                                ?>




                                        </div>
                                    <?}?>
                                    </div>
                                </div>
                                

            
                
         </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/footer.php"); ?>