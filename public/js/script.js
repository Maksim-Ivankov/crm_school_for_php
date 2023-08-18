function newPerson(){
    let name = $('.inputNewPersonName').val();
    let serName = $('.inputNewPersonSername').val();
    let old = $('.inputNewPersonAge').val();
    let telephone = $('.inputNewPersonTelephone').val();
    let curse = $('#cursePerson').val();
    let start = $('.inputNewPersonDateStart').val();
    let comment = $('.inputNewPersonComment').val();
    let dateTrial = $('.inputNewPersonDateTrial').val();
    let namePerent = $('.inputNewPersonNameParent').val();
    let status = $('#statusPerson').val();
    $.ajax({ 
        url: '/controllers/users.php?newPerson=1&name='+name+'&serName='+serName+'&old='+old+'&telephone='+telephone+'&curse='+curse+'&start='+start+'&comment='+comment+'&dateTrial='+dateTrial+'&namePerent='+namePerent+'&status='+status, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                $('.inputNewPersonName').val('');
                $('.inputNewPersonSername').val('');
                $('.inputNewPersonAge').val('');
                $('.inputNewPersonTelephone').val('');
                $('#cursePerson').val('');
                $('.inputNewPersonDateStart').val('');
                $('.inputNewPersonComment').val('');
                $('.inputNewPersonDateTrial').val('');
                $('.inputNewPersonNameParent').val('');
                $('#statusPerson').val('');
                alert('Ученик добавлен');
            } else {
                alert('Ошибка при добавлении ученика');
            }
        }
      });
    
}
function newCourses(){
    let title = $('.inputNewCoursestitle').val();
    let day = $('#dayNewCourses').val();
    let startTime = $('#startTimeNewCourses').val();
    let endTime = $('#endTimeNewCourses').val();
    let howMany = $('.inputNewCourseshowMany').val();
    let minAge = $('.inputNewCoursesMinAge').val();
    let maxAge = $('.inputNewCoursesMaxAge').val();
    let dateStart = $('.inputNewCoursesDateStart').val();
    let dateEnd = $('.inputNewCoursesDateEnd').val();
    
    $.ajax({ 
        url: '/controllers/users.php?title='+title+'&day='+day+'&startTime='+startTime+'&endTime='+endTime+'&howMany='+howMany+'&minAge='+minAge+'&maxAge='+maxAge+'&dateStart='+dateStart+'&dateEnd='+dateEnd, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                $('.inputNewCoursestitle').val('');
                $('#dayNewCourses').val('');
                $('#startTimeNewCourses').val('');
                $('#endTimeNewCourses').val('');
                $('.inputNewCourseshowMany').val('');
                $('.inputNewCoursesMinAge').val('');
                $('.inputNewCoursesMaxAge').val('');
                $('.inputNewCoursesDateStart').val('');
                $('.inputNewCoursesDateEnd').val('');
                alert('Курс добавлен');
            } else {
                alert('Ошибка при добавлении курса');
            }
        }
      });
    
}
function openCardPeople(id){
    window.location.href = '/public/cardStudent.php?id='+id;
}

function selectCoursePerson(element){
    let idCourse = $(element).attr('alt');
    let idPerson = $('.idStudentCardStudent').text();
    $.ajax({ 
        url: '/controllers/users.php?selectCourse=1&idCourse='+idCourse+'&idPerson='+idPerson, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                location.reload();
            } else {
                alert('ошибка');
            }
        }
      });
}
function deleteCoursePerson(element){
    let idCourse = $(element).attr('alt');
    let idPerson = $('.idStudentCardStudent').text();
    $.ajax({ 
        url: '/controllers/users.php?deleteCourse=1&idCourse='+idCourse+'&idPerson='+idPerson, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                location.reload();
            } else {
                alert('ошибка');
            }
        }
      });
}
function saveProfilePeople(){
    let id = $('.idStudentCardStudent').text();
    let name = $('.inputNewPersonSaveName').val();
    let serName = $('.inputNewPersonSaveSername').val();
    let old = $('.inputNewPersonSaveOld').val();
    let telephone = $('.inputNewPersonSaveTelephone').val();
    let curse = $('#cursePerson').val();
    let start = $('.inputNewPersonSaveStart').val();
    let comment = $('.inputNewPersonSaveComment').val();
    let dateTrial = $('.inputNewPersonSaveDateTrial').val();
    let namePerent = $('.inputNewPersonSaveNameParent').val();
    let status = $('#statusPerson').val();
    $.ajax({ 
        url: '/controllers/users.php?saveProfilePerson=1&id='+id+'&name='+name+'&serName='+serName+'&old='+old+'&telephone='+telephone+'&curse='+curse+'&start='+start+'&comment='+comment+'&dateTrial='+dateTrial+'&namePerent='+namePerent+'&status='+status, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                alert('Изменения сохранены');
            } else {
                alert(data);
            }
        }
      });
}
function setDayBePeople(element){
    let mode = $('.modeInputClassSelect').val();
    let dateCurse = $(element).attr('alt');
    let idPeople = ($(element).children('.journalCourseTableDayPeople').attr('title'));
    let idCourse = $('.idCurseJurnalCourse').text();
    $.ajax({ 
        url: '/controllers/users.php?visit=1&id='+idPeople+'&dateCurse='+dateCurse+'&idCourse='+idCourse+'&mode='+mode, 
        dataType: 'html',
        success: function(data){
            // location.reload();
                window.location.replace('/public/journalCourse.php?course='+idCourse+'&mode='+mode);
        }
      });
}

function searchTable() {
    var input, filter, found, table, tr, td, i, j;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            
            tr[i].style.display = "none";
            tr[0].style.display = "";
        }
    }
}

//далее код для живого поиска клиентов на странице оплаты


function fill(element) {
    let NameSername = $(element).html();
    $('.inputNewPersonInputPay').val(NameSername);
    $('.searchResultAjax').addClass('closePayStudent');
    $('.searchResultAjaxIdStudent').html($(element).attr('alt'));
 }
  
 $(document).ready(function() {
    $("#search").keyup(function() {
        var name = $('#search').val();
        if (name == "") {
            $(".searchResultAjax").html("");
        }
        else {
            $.ajax({ 
                type: "POST",
                url: "/controllers/searchStudent.php",
                data: {
                    search: name
                },
                success: function(html) { 
                    $(".searchResultAjax").html(html).show(); 
                }
            });
        } 
    });
 });

//конец кода для живого поиска клиентов на странице оплаты

function getNewPay(){
    let idStudent = $('.searchResultAjaxIdStudent').html();
    let datePay = $('.inputPayDate').val();
    let pricePay = $('.inputPayPrice').val();
    let commentPay = $('.inputPayComment').val();
    $.ajax({ 
        url: '/controllers/users.php?newPay=1&idStudent='+idStudent+'&datePay='+datePay+'&pricePay='+pricePay+'&commentPay='+commentPay, 
        dataType: 'html',
        success: function(){
            location.reload();
        }
      });

}
function changePay(element){
    $('.wrapperPayNewPayChange').removeClass('searchResultAjaxIdStudent');
    let idStudent = ($(element).attr('title')); //на самом деле это id операции
    let datePay = ($(element).children('.ourStudentTableTdDatePay').text());
    let pricePay = ($(element).children('.ourStudentTableTdPricePay').text());
    let commentPay = ($(element).children('.ourStudentTableTdCommentPay').text());
    let student = ($(element).children('.ourStudentTableTdStudentPay').text());
    let idStudentThis = ($(element).children('.idStudentThis').text());
    $('.inputPayDateСhange').val(datePay);
    $('.inputPayPriceСhange').val(pricePay);
    $('.inputNewPersonChange').val(student);
    $('.inputPayCommentСhange').val(commentPay);
    $('.payIdOperation').val(idStudent);
    $('.idStudentThisInput').val(idStudentThis);
}
function setPayСhange(){
    let datePay = $('.inputPayDateСhange').val();
    let pricePay = $('.inputPayPriceСhange').val();
    let commentPay = $('.inputPayCommentСhange').val();
    let idOperation = $('.payIdOperation').val();
    let idStudent = $('.idStudentThisInput').val();
    $.ajax({ 
        url: '/controllers/users.php?PayСhange=1&idOperation='+idOperation+'&datePay='+datePay+'&pricePay='+pricePay+'&commentPay='+commentPay+'&idStudent='+idStudent, 
        dataType: 'html',
        success: function(){
            alert('Изменения сохранены');
            location.reload();
        }
      });

}
function setPayСhangeDelete(){
    let datePay = $('.inputPayDateСhange').val();
    let pricePay = $('.inputPayPriceСhange').val();
    let commentPay = $('.inputPayCommentСhange').val();
    let idOperation = $('.payIdOperation').val();
    let idStudent = $('.idStudentThisInput').val();
    $.ajax({ 
        url: '/controllers/users.php?setPayСhangeDelete=1&idOperation='+idOperation+'&datePay='+datePay+'&pricePay='+pricePay+'&commentPay='+commentPay+'&idStudent='+idStudent, 
        dataType: 'html',
        success: function(){
            alert('Оплата удалена');
            location.reload();
        }
      });

}

function getNewCost(){
    let date = $('.inputPayDate').val();
    let price = $('.inputPayPrice').val();
    let comment = $('.inputPayComment').val();
    $.ajax({ 
        url: '/controllers/users.php?newCost=1&date='+date+'&price='+price+'&comment='+comment, 
        dataType: 'html',
        success: function(){
            location.reload();
        }
      });
}

function changeCost(element){
    $('.wrapperPayNewPayChange').removeClass('searchResultAjaxIdStudent');
    let idCost = ($(element).attr('title'));
    let dateCost = ($(element).children('.ourStudentTableTdDatePay').text());
    let priceCost = ($(element).children('.ourStudentTableTdPricePay').text());
    let commentCost = ($(element).children('.ourStudentTableTdCommentPay').text());
    $('.inputPayDateСhange').val(dateCost);
    $('.inputPayPriceСhange').val(priceCost);
    $('.inputPayCommentСhange').val(commentCost);
    $('.payIdOperation').val(idCost);
}

function setCostСhange(){
    let dateCost = $('.inputPayDateСhange').val();
    let priceCost = $('.inputPayPriceСhange').val();
    let commentCost = $('.inputPayCommentСhange').val();
    let idCost = $('.payIdOperation').val();
    $.ajax({ 
        url: '/controllers/users.php?CostСhange=1&idCost='+idCost+'&dateCost='+dateCost+'&priceCost='+priceCost+'&commentCost='+commentCost, 
        dataType: 'html',
        success: function(){
            alert('Изменения сохранены');
            location.reload();
        }
      });
}

function setCostСhangeDelete(){
    let dateCost = $('.inputPayDateСhange').val();
    let priceCost = $('.inputPayPriceСhange').val();
    let commentCost = $('.inputPayCommentСhange').val();
    let idCost = $('.payIdOperation').val();
    $.ajax({ 
        url: '/controllers/users.php?CostDelete=1&idCost='+idCost+'&dateCost='+dateCost+'&priceCost='+priceCost+'&commentCost='+commentCost, 
        dataType: 'html',
        success: function(){
            alert('Оплата удалена');
            location.reload();
        }
      });
}

function newEvent(){
    let titleEvent = $('.inputNewCoursestitle').val();
    let day = $('#dayNewCourses').val();
    let startTimeEvent = $('#startTimeNewCourses').val();
    let endTimeEvent = $('#endTimeNewCourses').val();
    let countPeople = $('.inputNewCourseshowMany').val();
    let minAge = $('.inputNewCoursesMinAge').val();
    let maxAge = $('.inputNewCoursesMaxAge').val();
    let dateStart = $('.inputNewCoursesDateStart').val();
    let dateEnd = $('.inputNewCoursesDateEnd').val();
    let price = $('.inputNewCoursesPrice').val();
    $.ajax({ 
        url: '/controllers/users.php?newEvent=1&titleEvent='+titleEvent+'&day='+day+'&startTimeEvent='+startTimeEvent+'&endTimeEvent='+endTimeEvent+'&countPeople='+countPeople+'&minAge='+minAge+'&maxAge='+maxAge+'&dateStart='+dateStart+'&dateEnd='+dateEnd+'&price='+price, 
        dataType: 'html',
        success: function(){
            alert('Мероприятие добавлено');
            location.reload();
        }
      });
}

function selectEventPerson(element){
    let idCourse = $(element).attr('alt');
    let idPerson = $('.idStudentCardStudent').text();
    $.ajax({ 
        url: '/controllers/users.php?selectEvent=1&idEvent='+idCourse+'&idPerson='+idPerson, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                location.reload();
            } else {
                alert('ошибка');
            }
        }
      });
}

function deleteEventPerson(element){
    let idCourse = $(element).attr('alt');
    let idPerson = $('.idStudentCardStudent').text();
    $.ajax({ 
        url: '/controllers/users.php?deleteEvent=1&idCourse='+idCourse+'&idPerson='+idPerson, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                location.reload();
            } else {
                alert('ошибка');
            }
        }
      });
}

function setDayBePeopleEvent(element){
    let mode = $('.modeInputClassSelect').val();
    let dateCurse = $(element).attr('alt');
    let idPeople = ($(element).children('.journalCourseTableDayPeople').attr('title'));
    let idCourse = $('.idCurseJurnalCourse').text();
    $.ajax({ 
        url: '/controllers/users.php?eventForJournal=1&id='+idPeople+'&dateCurse='+dateCurse+'&idCourse='+idCourse+'&mode='+mode, 
        dataType: 'html',
        success: function(data){
                window.location.replace('/public/journalEvent.php?event='+idCourse+'&mode='+mode);
        }
      });
}

function changeEventForEditEvent(element){
    $('.newCoursesEditEvent').removeClass('searchResultAjaxIdStudent');
    let id = ($(element).attr('title'));
    let title = ($(element).children('.editEventTableTitle').text());
    let startTime = ($(element).children('.editEventTableStartTime').text());
    let endTime = ($(element).children('.editEventTableEndTime').text());
    let dateStart = ($(element).children('.editEventTableDateStart').text());
    let dateEnd = ($(element).children('.editEventTableDateEnd').text());
    let countPeople = ($(element).children('.editEventTableCountPeople').text());
    let minAge = ($(element).children('.editEventTableMinAge').text());
    let maxAge = ($(element).children('.editEventTableMaxAge').text());
    let teblePrice = ($(element).children('.editEventTablePrice').text());
    let status = ($(element).children('.editEventTableStatusNumber').text());
    $('.inputNewCoursestitle').val(title);
    $('#startTimeNewCourses').val(startTime);
    $('#endTimeNewCourses').val(endTime);
    $('.inputNewCourseshowMany').val(countPeople);
    $('.inputNewCoursesMinAge').val(minAge);
    $('.inputNewCoursesMaxAge').val(maxAge);
    $('.inputNewCoursesDateStart').val(dateStart);
    $('.inputNewCoursesDateEnd').val(dateEnd);
    $('.inputNewCoursesPrice').val(teblePrice);
    $('.inputNewCoursesIdEvent').val(id);
    if (status=='1'){
        $('.inputNewCoursesStatusEvent').val(status);
        $('.buttonUpdateStatusEvent').text('Завершить мероприятие');
    } else {
        $('.inputNewCoursesStatusEvent').val(status);
        $('.buttonUpdateStatusEvent').text('Возобновить мероприятие');
    }
}

function editEventFunc(){
    let title = $('.inputNewCoursestitle').val();
    let startTime = $('#startTimeNewCourses').val();
    let endTime = $('#endTimeNewCourses').val();
    let countPeople = $('.inputNewCourseshowMany').val();
    let minAge = $('.inputNewCoursesMinAge').val();
    let maxAge = $('.inputNewCoursesMaxAge').val();
    let dateStart = $('.inputNewCoursesDateStart').val();
    let dateEnd = $('.inputNewCoursesDateEnd').val();
    let Price = $('.inputNewCoursesPrice').val();
    let id = $('.inputNewCoursesIdEvent').val();
    $.ajax({ 
        url: '/controllers/users.php?editEventSettings=1&id='+id+'&title='+title+'&startTime='+startTime+'&endTime='+endTime+'&countPeople='+countPeople+'&minAge='+minAge+'&maxAge='+maxAge+'&dateStart='+dateStart+'&dateEnd='+dateEnd+'&Price='+Price, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                alert('изменения сохранены');
                location.reload();
            } else {
                alert('ошибка');
            }
        }
      });

}
function deleteEvent(){
    let id = $('.inputNewCoursesIdEvent').val();
    $.ajax({ 
        url: '/controllers/users.php?editEventSettingsDelete=1&id='+id, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                alert('Мероприятие удалено');
                location.reload();
            } else {
                alert('ошибка');
            }
        }
      });
}

function updateStatusEvent(){
    let id = $('.inputNewCoursesIdEvent').val();
    let status = $('.inputNewCoursesStatusEvent').val();
    $.ajax({ 
        url: '/controllers/users.php?updateStatusEvent=1&id='+id+'&status='+status, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                alert('Статус изменён');
                location.reload();
            } else {
                alert('ошибка');
            }
        }
      });
}

function changeCoursesForEditCourses(element){
    $('.newCoursesEditEvent').removeClass('searchResultAjaxIdStudent');
    let id = ($(element).attr('title'));
    let title = ($(element).children('.editEventTableTitle').text());
    let day = ($(element).children('.editEventTableDay').text());
    let startTime = ($(element).children('.editEventTableStartTime').text());
    let endTime = ($(element).children('.editEventTableEndTime').text());
    let dateStart = ($(element).children('.editEventTableDateStart').text());
    let dateEnd = ($(element).children('.editEventTableDateEnd').text());
    let countPeople = ($(element).children('.editEventTableCountPeople').text());
    let minAge = ($(element).children('.editEventTableMinAge').text());
    let maxAge = ($(element).children('.editEventTableMaxAge').text());
    let status = ($(element).children('.editEventTableStatusNumber').text());
    $('.inputNewCoursestitle').val(title);
    $('#dayNewCourses').val(day);
    $('#startTimeNewCourses').val(startTime);
    $('#endTimeNewCourses').val(endTime);
    $('.inputNewCourseshowMany').val(countPeople);
    $('.inputNewCoursesMinAge').val(minAge);
    $('.inputNewCoursesMaxAge').val(maxAge);
    $('.inputNewCoursesDateStart').val(dateStart);
    $('.inputNewCoursesDateEnd').val(dateEnd);
    $('.inputNewCoursesIdEvent').val(id);
    if (status=='1'){
        $('.inputNewCoursesStatusEvent').val(status);
        $('.buttonUpdateStatusEvent').text('Завершить курс');
    } else {
        $('.inputNewCoursesStatusEvent').val(status);
        $('.buttonUpdateStatusEvent').text('Возобновить курс');
    }
}

function editCoursesFunc(){
    let title  = $('.inputNewCoursestitle').val();
    let day = $('#dayNewCourses').val();
    let startTime = $('#startTimeNewCourses').val();
    let endTime = $('#endTimeNewCourses').val();
    let countPeople = $('.inputNewCourseshowMany').val();
    let minAge = $('.inputNewCoursesMinAge').val();
    let maxAge = $('.inputNewCoursesMaxAge').val();
    let dateStart = $('.inputNewCoursesDateStart').val();
    let dateEnd = $('.inputNewCoursesDateEnd').val();
    let id = $('.inputNewCoursesIdEvent').val();
    let status = $('.inputNewCoursesStatusEvent').val();
    $.ajax({ 
        url: '/controllers/users.php?editCoursesSettings=1&id='+id+'&title='+title+'&day='+day+'&startTime='+startTime+'&endTime='+endTime+'&countPeople='+countPeople+'&minAge='+minAge+'&maxAge='+maxAge+'&dateStart='+dateStart+'&dateEnd='+dateEnd+'&status='+status, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                alert('изменения сохранены');
                location.reload();
            } else {
                alert('ошибка');
            }
        }
      });

}

function deleteCourses(){
    let id = $('.inputNewCoursesIdEvent').val();
    $.ajax({ 
        url: '/controllers/users.php?editCoursesSettingsDelete=1&id='+id, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                alert('Курс удалён');
                location.reload();
            } else {
                alert('ошибка');
            }
        }
      });
}

function updateStatusCourses(){
    let id = $('.inputNewCoursesIdEvent').val();
    let status = $('.inputNewCoursesStatusEvent').val();
    $.ajax({ 
        url: '/controllers/users.php?updateStatusCourse=1&id='+id+'&status='+status, 
        dataType: 'html',
        success: function(data){
            if(data==1){
                alert('Статус изменён');
                location.reload();
            } else {
                alert('ошибка');
            }
        }
      });
}