<div class="main">
  <div class="left">
    <ul>
    </a><li class="menu-heading"><a href="/public/home.php"><span class="leftSpanLogo"><img src="/public/img/menu/1.png" class="leftSpanLogoImg"
            alt=""></span></li></a>
      <li><a data-toggle="tab" href="/public/newStudent.php"><img src="/public/img/menu/2.jpg" class="leftLiImg">Добавить ученика</a></li>
      <li><a data-toggle="tab" href="/public/ourStudent.php"><img src="/public/img/menu/3.png" class="leftLiImg"> Все ученики</a></li>
      <li><a data-toggle="tab" href="/public/event.php"><img src="/public/img/menu/4.png" class="leftLiImg"> Мероприятия</a></li>
      <!-- <li><a data-toggle="tab" href=""><img src="/public/img/menu/5.png" class="leftLiImg"> Оплаты</a>
      </li> -->
      <li><a data-toggle="tab" href="/public/journal.php"><img src="/public/img/menu/6.png" class="leftLiImg"> Журнал</a>
      </li>
      <li><a data-toggle="tab" href="/public/pay.php"><img src="/public/img/menu/9.png" class="leftLiImg leftLiImgInvert">Оплаты</a>
      </li>
      <li><a data-toggle="tab" href="/public/costs.php"><img src="/public/img/menu/10.png" class="leftLiImg leftLiImgInvert">Расходы</a>
      </li>
      <li><a data-toggle="tab" href="/public/settings.php"><img src="/public/img/menu/7.png" class="leftLiImg"> Настройки</a></li>

    </ul>
  </div>
  <div class="right">
        <div class="navUpRightWrap">
            <div class="navUpRightWrapStruct">
                <p>
                    <span ><a class="navUpRightWrapStruct1" href="/public/home.php">RoboCore</a></span> 
                    <span class="navUpRightWrapStruct2">/ <?
                    if (basename($_SERVER['PHP_SELF'])=='home.php'){
                      echo 'Главная';
                    }
                    if (basename($_SERVER['PHP_SELF'])=='newStudent.php'){
                      echo 'Добавить ученика';
                    }
                    if (basename($_SERVER['PHP_SELF'])=='ourStudent.php'){
                      echo 'Все ученики';
                    }
                    if (basename($_SERVER['PHP_SELF'])=='pay.php'){
                      echo 'Оплаты';
                    }
                    if (basename($_SERVER['PHP_SELF'])=='costs.php'){
                      echo 'Расходы';
                    }
                    if (basename($_SERVER['PHP_SELF'])=='settings.php'){
                      echo 'Настройки';
                    }
                    if (basename($_SERVER['PHP_SELF'])=='event.php'){
                      echo 'Мероприятия';
                    }
                    if (basename($_SERVER['PHP_SELF'])=='settingsNewCourse.php'){
                      echo '<a class="navUpRightWrapStruct1" href="/public/settings.php">Настройки</a> / Добавить курс';
                    }
                    if (basename($_SERVER['PHP_SELF'])=='settingsNewEvent.php'){
                      echo '<a class="navUpRightWrapStruct1" href="/public/settings.php">Настройки</a> / Добавить мероприятие';
                    }
                    if (basename($_SERVER['PHP_SELF'])=='settingsEditEvent.php'){
                      echo '<a class="navUpRightWrapStruct1" href="/public/settings.php">Настройки</a> / Редактировать мероприятие';
                    }
                    if (basename($_SERVER['PHP_SELF'])=='settingsEditCourse.php'){
                      echo '<a class="navUpRightWrapStruct1" href="/public/settings.php">Настройки</a> / Редактировать курс';
                    }
                    if (basename($_SERVER['PHP_SELF'])=='journal.php'){
                      echo ' Журнал';
                    }
                    if ($_GET['course']){
                      $ourCurses = getAll($link, 'courses');
                      foreach($ourCurses as $item){
                        if($_GET['course']==$item['id']){
                          echo ' <a class="navUpRightWrapStruct1" href="/public/journal.php">Журнал</a> / '.$item['title'].' '.$item['startTime'].':00 - '.$item['endTime'].':00';
                          break;
                        }
                      }
                    }
                    if ($_GET['event']){
                      $ourCurses = getAll($link, 'event');
                      foreach($ourCurses as $item){
                        if($_GET['event']==$item['id']){
                          echo ' <a class="navUpRightWrapStruct1" href="/public/event.php">Мероприятия</a> / '.$item['title'].' '.date('d.m.Y', strtotime($item['dateStart'])).' - '.date('d.m.Y', strtotime($item['dateEnd']));
                          break;
                        }
                      }
                    }
                    if ($_GET['id']){
                      $ourCurses = getAll($link, 'student');
                      foreach($ourCurses as $item){
                        if($_GET['id']==$item['id']){
                          echo ' <a class="navUpRightWrapStruct1" href="/public/ourStudent.php">Все ученики</a> / '.$item['name'].' '.$item['sername'];
                          break;
                        }
                      }
                    }
                    

                    
                    ?></span>
                </p>
            </div>
            <div class="navUpRightWrapCardUser">
                <div class="navUpRightWrapCardUser1">
                    <img src="/public/img/menu/8.png" class="navUpRightWrapCardUserImg" alt="">
                </div>
                
                <div class="navUpRightWrapCardUser2">
                    
                    <p class="navUpRightWrapCardUser21">
                      <? if ($_SESSION['name']!=''){
                        $outputNameUser = $_SESSION['name'].' '.$_SESSION['sername'][0];
                        echo $outputNameUser;
                      } else {
                        echo $_SESSION['login']; 
                      }?>
                    </p>
                    <p class="navUpRightWrapCardUser22">
                        <?
                            if ($_SESSION['role']==0){
                                echo 'Пользователь';
                            } else if ($_SESSION['role']==1){
                                echo 'Админ';
                            }
                        ?>
                    </p>
                    <div class="dropdown-content">
                        <a href="/public/profile.php">Профиль</a>
                        <a href="/controllers/users.php?logOut=1">Выход</a>
                      </div>
                </div>
            </div>
            </div>
        