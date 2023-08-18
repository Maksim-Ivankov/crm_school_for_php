<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/header.php"); ?>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/nav.php"); ?>
        <div class="rightMainWrap">
            <? 
                $ourCurses = getAll($link, 'courses');
                $pn=Array();
                $vt=Array();
                $sr=Array();
                $sht=Array();
                $pt=Array();
                $sb=Array();
                $vs=Array();
                foreach($ourCurses as $item){
                    if($item['status']==1){
                    if ($item['day']==1){
                        array_push($pn,$item);
                    }
                    if ($item['day']==2){
                        array_push($vt,$item);
                    }
                    if ($item['day']==3){
                        array_push($sr,$item);
                    }
                    if ($item['day']==4){
                        array_push($sht,$item);
                    }
                    if ($item['day']==5){
                        array_push($pt,$item);
                    }
                    if ($item['day']==6){
                        array_push($sb,$item);
                    }
                    if ($item['day']==7){
                        array_push($vs,$item);
                    }
                }}
            ?>
            <?
                        function timeSort($time1, $time2) {
                            if ($time1["startTime"] == $time2["startTime"]) {
                              return 0;
                            }
                            return ($time1["startTime"] < $time2["startTime"]) ? -1 : 1;
                            };   	 
                        usort($pn, "timeSort");
                        usort($vt, "timeSort");
                        usort($sr, "timeSort");
                        usort($sht, "timeSort");
                        usort($pt, "timeSort");
                        usort($sb, "timeSort");
                        usort($vs, "timeSort");
                    ?>
            <div class="journalWrapper">
                <div class="journalWrapperTittle">
                    <div class="journalWrapperDibTittle"><p class="journalWrapperDibTittleP">Понедельник</p></div>
                    <div class="journalWrapperDibTittle"><p class="journalWrapperDibTittleP">Вторник</p></div>
                    <div class="journalWrapperDibTittle"><p class="journalWrapperDibTittleP">Среда</p></div>
                    <div class="journalWrapperDibTittle"><p class="journalWrapperDibTittleP">Четверг</p></div>
                    <div class="journalWrapperDibTittle"><p class="journalWrapperDibTittleP">Пятница</p></div>
                    <div class="journalWrapperDibTittle"><p class="journalWrapperDibTittleP">Суббота</p></div>
                    <div class="journalWrapperDibTittle"><p class="journalWrapperDibTittleP">Воскресенье</p></div>
                </div>
                <div class="journalWrapperTittle">
                    <div class="journalWrapperDibTittleDay">
                    <?
                            foreach($pn as $item){
                                ?> <a href="/public/journalCourse.php?course=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                    <div class="journalWrapperDibTittleDay">
                    <?
                            foreach($vt as $item){
                                ?> <a href="/public/journalCourse.php?course=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                    <div class="journalWrapperDibTittleDay">
                    <?
                            foreach($sr as $item){
                                ?> <a href="/public/journalCourse.php?course=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                    <div class="journalWrapperDibTittleDay">
                    <?
                            foreach($sht as $item){
                                ?> <a href="/public/journalCourse.php?course=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                    <div class="journalWrapperDibTittleDay">
                    <?
                            foreach($pt as $item){
                                ?> <a href="/public/journalCourse.php?course=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                    <div class="journalWrapperDibTittleDay">
                        <?
                            foreach($sb as $item){
                                ?> <a href="/public/journalCourse.php?course=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                    <div class="journalWrapperDibTittleDay">
                        <?
                            foreach($vs as $item){
                                ?> <a href="/public/journalCourse.php?course=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/footer.php"); ?>