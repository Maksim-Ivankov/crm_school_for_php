<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/header.php"); ?>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/nav.php"); ?>
        <div class="rightMainWrap">
            <? 
                $ourCurses = getAll($link, 'event');
                $pn=Array();
                $vt=Array();
                $sr=Array();
                $sht=Array();
                $pt=Array();
                $sb=Array();
                $vs=Array();
                foreach($ourCurses as $item){
                    if ($item['status']==1){
                    if ($item['day']==1){
                        $new = date('d.m.Y', strtotime($item['dateStart']));
                        $item['dayNow'] =  $new;
                        array_push($pn,$item);
                    }
                    if ($item['day']==2){
                        $new = date('d.m.Y', strtotime($item['dateStart']));
                        $item['dayNow'] =  $new;
                        array_push($vt,$item);
                    }
                    if ($item['day']==3){
                        $new = date('d.m.Y', strtotime($item['dateStart']));
                        $item['dayNow'] =  $new;
                        array_push($sr,$item);
                    }
                    if ($item['day']==4){
                        $new = date('d.m.Y', strtotime($item['dateStart']));
                        $item['dayNow'] =  $new;
                        array_push($sht,$item);
                    }
                    if ($item['day']==5){
                        $new = date('d.m.Y', strtotime($item['dateStart']));
                        $item['dayNow'] =  $new;
                        array_push($pt,$item);
                    }
                    if ($item['day']==6){
                        $new = date('d.m.Y', strtotime($item['dateStart']));
                        $item['dayNow'] =  $new;
                        array_push($sb,$item);
                    }
                    if ($item['day']==7){
                        $new = date('d.m.Y', strtotime($item['dateStart']));
                        $item['dayNow'] =  $new;
                        array_push($vs,$item);
                    }
                    if ($item['day']==8){
                        function getWeekday($date) {
                            return date('w', strtotime($date));
                        }
                        $thisEvent = setOneEventForId($link,$item['id']);
                        $dateStart = $thisEvent['dateStart'];
                        $dateEnd = $thisEvent['dateEnd'];
                        $dates = get_dates($dateStart, $dateEnd);
                        foreach($dates as $datesItem){
                            if (getWeekday($datesItem)==1){
                                $new = date('d.m.Y', strtotime($datesItem));
                                $item['dayNow'] =  $new;
                                array_push($pn,$item);
                            }
                            if (getWeekday($datesItem)==2){
                                $new = date('d.m.Y', strtotime($datesItem));
                                $item['dayNow'] =  $new;
                                array_push($vt,$item);
                            }
                            if (getWeekday($datesItem)==3){
                                $new = date('d.m.Y', strtotime($datesItem));
                                $item['dayNow'] =  $new;
                                array_push($sr,$item);
                            }
                            if (getWeekday($datesItem)==4){
                                $new = date('d.m.Y', strtotime($datesItem));
                                $item['dayNow'] =  $new;
                                array_push($sht,$item);
                            }
                            if (getWeekday($datesItem)==5){
                                $new = date('d.m.Y', strtotime($datesItem));
                                $item['dayNow'] =  $new;
                                array_push($pt,$item);
                            }
                            if (getWeekday($datesItem)==6){
                                $new = date('d.m.Y', strtotime($datesItem));
                                $item['dayNow'] =  $new;
                                array_push($sb,$item);
                            }
                            if (getWeekday($datesItem)==7){
                                $new = date('d.m.Y', strtotime($datesItem));
                                $item['dayNow'] =  $new;
                                array_push($vs,$item);
                            }
                            
                        }
                        

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
                                ?> <a href="/public/journalEvent.php?event=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['dayNow']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                    <div class="journalWrapperDibTittleDay">
                    <?
                            foreach($vt as $item){
                                ?> <a href="/public/journalEvent.php?event=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['dayNow']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                    <div class="journalWrapperDibTittleDay">
                    <?
                            foreach($sr as $item){
                                ?> <a href="/public/journalEvent.php?event=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['dayNow']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                    <div class="journalWrapperDibTittleDay">
                    <?
                            foreach($sht as $item){
                                ?> <a href="/public/journalEvent.php?event=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['dayNow']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                    <div class="journalWrapperDibTittleDay">
                    <?
                            foreach($pt as $item){
                                ?> <a href="/public/journalEvent.php?event=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['dayNow']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                    <div class="journalWrapperDibTittleDay">
                        <?
                            foreach($sb as $item){
                                ?> <a href="/public/journalEvent.php?event=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['dayNow']?></p>
                                        <p class="journalWrapperDibTittleDayCardPAge"><?=$item['minAge']?> - <?=$item['maxAge']?> лет</p>
                                        <p class="journalWrapperDibTittleDayCardTime"><?=$item['startTime']?>:00 - <?=$item['endTime']?>:00</p>
                                    </div></a> <?
                            }
                        ?>
                    </div>
                    <div class="journalWrapperDibTittleDay">
                        <?
                            foreach($vs as $item){
                                ?> <a href="/public/journalEvent.php?event=<?=$item['id']?>" class="journalWrapperDibTittleDayCardA"><div class="journalWrapperDibTittleDayCard">
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['title']?></p>
                                        <p class="journalWrapperDibTittleDayCardP"><?=$item['dayNow']?></p>
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