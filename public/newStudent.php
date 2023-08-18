<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/header.php"); ?>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/nav.php"); ?>
        <div class="rightMainWrap">
            
            <div class="newPersonWrap">
                <div class="newPersonWrapLeft">
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
                    <input type="text" placeholder="Вася" class="inputNewPerson inputNewPersonName">
                    <input type="text" placeholder="Пупкин" class="inputNewPerson inputNewPersonSername">
                    <input type="text" placeholder="12" class="inputNewPerson inputNewPersonAge">
                    <input type="text" placeholder="Катя" class="inputNewPerson inputNewPersonNameParent">
                    <input type="text" placeholder="89183686465" class="inputNewPerson inputNewPersonTelephone">
                    <input type="date"  class="inputNewPerson inputNewPersonDateTrial">
                    <input type="date"  class="inputNewPerson inputNewPersonDateStart">
                    <select id="statusPerson" class="inputNewPersonStatus">
                        <option value="1">Обучается</option>
                        <option value="2">Перерыв</option>
                        <option value="3">Перестали ходить</option> 
                        <option value="4">Уехали</option> 
                    </select>
                    <select id="cursePerson" class="inputNewPersonCurse">
                        <option value="1">Робототехника</option>
                        <option value="2">Программирование</option>
                        <option value="3">Рт и прог</option> 
                        <option value="4">Репетиторство</option> 
                        <option value="5">Две робототехники</option> 
                         
                    </select>
                    <input type="text"  class="inputNewPerson inputNewPersonComment">
                </div>
                <a class="buttonNewPerson" onclick="newPerson()">Добавить ученика</a>
            </div>

        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/footer.php"); ?>