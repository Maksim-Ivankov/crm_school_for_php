<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/header.php"); ?>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/nav.php"); ?>
        <div class="rightMainWrap">

            <div class="newCourses">
                <div class="newCoursesLeft">
                    <p class="labelNewCourses"> Название мероприятия </p>
                    <p class="labelNewCourses"> День недели </p>
                    <p class="labelNewCourses"> Время проведения </p>
                    <p class="labelNewCourses"> Кол-во учеников </p>
                    <p class="labelNewCourses"> Мин/макс возраст </p>
                    <p class="labelNewCourses"> Дата запуска </p>
                    <p class="labelNewCourses"> Дата окончания </p>
                    <p class="labelNewCourses"> Стоимость,  руб </p>
                </div>
                <div class="newCoursesRight">
                    <input type="text" placeholder="Лагерь" class="inputNewCourses inputNewCoursestitle"> 
                    <select id="dayNewCourses" class="inputNewCourses">
                        <option value="6">Суббота</option>
                        <option value="7">Воскресенье</option>
                        <option value="1">Понедельник</option> 
                        <option value="2">Вторник</option> 
                        <option value="3">Среда</option> 
                        <option value="4">Четверг</option> 
                        <option value="5">Пятница</option> 
                        <option value="8">Все дни в период</option> 
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
                    <input type="text" placeholder="3000" class="inputNewCourses inputNewCoursesPrice">
                </div>
                <a class="buttonNewCourses buttonNewCoursesEvent" onclick="newEvent()">Добавить мероприятие</a>
            </div>


        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/footer.php"); ?>