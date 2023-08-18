<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/header.php"); ?>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/nav.php"); ?>
        <div class="rightMainWrap">
            <div class="wrapsettingsEditEvent">

            <div class="newCourses newCoursesEditEvent searchResultAjaxIdStudent">
                <div class="newCoursesLeft">
                    <p class="labelNewCourses"> Название курса </p>
                    <p class="labelNewCourses"> День недели </p>
                    <p class="labelNewCourses"> Время проведения </p>
                    <p class="labelNewCourses"> Кол-во учеников </p>
                    <p class="labelNewCourses"> Мин/макс возраст </p>
                    <p class="labelNewCourses"> Дата запуска </p>
                    <p class="labelNewCourses"> Дата окончания </p>
                </div>
                <div class="newCoursesRight">
                    <input type="text" placeholder="Робототехника" class="inputNewCourses inputNewCoursestitle"> 
                    <select id="dayNewCourses" class="inputNewCourses">
                        <option value="6">Суббота</option>
                        <option value="7">Воскресенье</option>
                        <option value="1">Понедельник</option> 
                        <option value="2">Вторник</option> 
                        <option value="3">Среда</option> 
                        <option value="4">Четверг</option> 
                        <option value="5">Пятница</option> 
                    </select>   
                    <select id="startTimeNewCourses" class="inputNewCourses">
                        <option value="9">9:00</option>
                        <option value="10">10:00</option>
                        <option value="11">11:00</option> 
                        <option value="12">12:00</option> 
                        <option value="13">13:00</option> 
                        <option value="14">14:00</option> 
                        <option value="15">15:00</option> 
                        <option value="16">16:00</option> 
                        <option value="17">17:00</option> 
                        <option value="18">18:00</option> 
                    </select>   
                    <select id="endTimeNewCourses" class="inputNewCourses">
                        <option value="10">10:00</option>
                        <option value="11">11:00</option> 
                        <option value="12">12:00</option> 
                        <option value="13">13:00</option> 
                        <option value="14">14:00</option> 
                        <option value="15">15:00</option> 
                        <option value="16">16:00</option> 
                        <option value="17">17:00</option> 
                        <option value="18">18:00</option> 
                        <option value="19">19:00</option> 
                    </select>   
                    <input type="text" placeholder="10" class="inputNewCourses inputNewCourseshowMany">    
                    <input type="text" placeholder="6" class="inputNewCourses inputNewCoursesAge inputNewCoursesMinAge">    
                    <input type="text" placeholder="9" class="inputNewCourses inputNewCoursesAge inputNewCoursesMaxAge">    
                    <input type="date"  class="inputNewCourses inputNewCoursesDateStart">
                    <input type="date"  class="inputNewCourses inputNewCoursesDateEnd">
                    <input type="text" class="inputNewCoursesIdEvent" style="display:none;">
                    <input type="text" class="inputNewCoursesStatusEvent" style="display:none;">
                </div>
                <a class="buttonNewCourses buttonNewCoursesEvent" onclick="editCoursesFunc()">Изменить мероприятие</a>
                <a class="buttonNewCourses buttonNewCoursesEvent buttonUpdateStatusEvent"  onclick="updateStatusCourses()"></a>
                <a class="buttonNewCourses buttonNewCoursesEvent" onclick="deleteCourses()">Удалить мероприятие</a>
            </div>


                <p class="wrapsettingsEditEventTitile">Все мероприятия</p>
                <table class="ourStudentTable ourStudentTablePay">
                    <tr class="ourStudentTableTr ourStudentTableTrTitle">
                        <td class="ourStudentTableTd ourStudentTableTdTitle">№</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Название</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">День недели</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Время начала</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Время окончания</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Дата начала</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Дата окончания</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Кол-во человек</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Мин возраст</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Макс возраст</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Статус</td>
                    </tr>
                <?
                    $ourEvents = getAll($link,'courses');
                    $countEvents = 1;
                    foreach($ourEvents as $ourEventsItem){
                        ?>
                        <tr class="trHoverEditEvents" title="<?=$ourEventsItem['id']?>" onclick="changeCoursesForEditCourses(this)">
                            <td class="ourStudentTableTd ourStudentTableTdTitleEditEvent"><?=$countEvents++?></td>
                            <td class="ourStudentTableTd editEventTableTitle ourStudentTableTdTitleEditEvent"><?=$ourEventsItem['title']?></td>
                            <td class="ourStudentTableTd editEventTableDay ourStudentTableTdTitleEditEvent"><?=$ourEventsItem['day']?></td>
                            <td class="ourStudentTableTd editEventTableStartTime ourStudentTableTdTitleEditEvent"><?=$ourEventsItem['startTime']?></td>
                            <td class="ourStudentTableTd editEventTableEndTime ourStudentTableTdTitleEditEvent"><?=$ourEventsItem['endTime']?></td>
                            <td class="ourStudentTableTd editEventTableDateStart ourStudentTableTdTitleEditEvent"><?=$ourEventsItem['dateStart']?></td>
                            <td class="ourStudentTableTd editEventTableDateEnd ourStudentTableTdTitleEditEvent"><?=$ourEventsItem['dateEnd']?></td>
                            <td class="ourStudentTableTd editEventTableCountPeople ourStudentTableTdTitleEditEvent"><?=$ourEventsItem['howMany']?></td>
                            <td class="ourStudentTableTd editEventTableMinAge ourStudentTableTdTitleEditEvent"><?=$ourEventsItem['minAge']?></td>
                            <td class="ourStudentTableTd editEventTableMaxAge ourStudentTableTdTitleEditEvent"><?=$ourEventsItem['maxAge']?></td>
                            <td class="ourStudentTableTd editEventTableStatusNumber ourStudentTableTdTitleEditEvent" style="display:none;"><?=$ourEventsItem['status']?></td>
                            <td class="ourStudentTableTd editEventTableStatus ourStudentTableTdTitleEditEvent"><?
                            if($ourEventsItem['status']=='1'){
                                echo '<p style="background-color:green; padding:2px;color:white;">Действующее</p>';
                            } else {
                                echo '<p style="background-color:red; padding:2px;color:white;">Завершено</p>';
                            }
                            ?></td>
                        </tr>
                        <?
                    }
                ?>
                </table>


            </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/footer.php"); ?>