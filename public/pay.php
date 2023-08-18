<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/header.php"); ?>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/nav.php"); ?>
        <div class="rightMainWrap">
            <div class="wrapperPay">
                <div class="wrapperPayNewPay">
                    <p class="wrapperPayNewPayTitile">Новая оплата</p>
                    <div class="wrapperPayNewPayFlex">
                        <input type="date"  class="inputNewPerson inputPayDate inputNewPersonDateTrial">
                        <input type="text"  class="inputNewPerson inputPayPrice inputNewPersonDateTrial inputNewPersonDateTrialPrice" placeholder="Cумма, руб">
                        <div>
                            <input type="text" id="search" class="inputNewPerson inputNewPersonInputPay" placeholder="Введите Имя или Фамилию ученика" autocomplete="off">
                            <div class="searchResultAjax"></div>
                            <p class="searchResultAjaxIdStudent"></p>
                        </div>
                        <input type="text"  class="inputNewPerson inputPayComment inputNewPersonDateTrial inputNewPersonDateTrialComment" placeholder="Комментарий">
                        <a onclick="getNewPay()" class="buttonNewPerson buttonNewPersonPay">Добавить</a>
                    </div>
                </div>
                <div class="wrapperPayNewPay wrapperPayNewPayChange searchResultAjaxIdStudent">
                    <p class="wrapperPayNewPayTitile">Изменить оплату</p>
                    <div class="wrapperPayNewPayFlex">
                        <input type="date"  class="inputNewPerson inputPayDateСhange inputNewPersonDateTrial">
                        <input type="text"  class="payIdOperation" style="display:none;">
                        <input type="text"  class="idStudentThisInput" style="display:none;">
                        <input type="text"  class="inputNewPerson inputPayPriceСhange inputNewPersonDateTrial inputNewPersonDateTrialPrice" placeholder="Cумма, руб">
                        <div>
                            <input type="text" id="search" class="inputNewPerson inputNewPersonChange inputNewPersonInputPay" readonly>
                        </div>
                        <input type="text"  class="inputNewPerson inputPayCommentСhange inputNewPersonDateTrial inputNewPersonDateTrialComment" placeholder="Комментарий">
                        <a onclick="setPayСhange()" alt="" class="buttonNewPerson buttonNewPersonPay buttonNewPersonPayChange">Изменить</a>
                        <a onclick="setPayСhangeDelete()" class="buttonNewPerson buttonNewPersonPay buttonNewPersonPayDelete">Удалить</a>
                    </div>
                </div>
                <div class="taplePay">
                    <table class="ourStudentTable ourStudentTablePay">
                    <tr class="ourStudentTableTr ourStudentTableTrTitle">
                        <td class="ourStudentTableTd ourStudentTableTdTitle">№</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Ученик</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Дата</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Сумма</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle ourStudentTableTdTitleComment">Комментарий</td>
                    </tr>
                    <?
                        $ourPay = getAll($link,'pay');
                        $countPay=1;
                        foreach($ourPay as $ourPayItem){
                            ?>
                            <tr class="ourStudentTableTr ourStudentTableTrTitlePay" title="<?=$ourPayItem['id'];?>" onclick="changePay(this)">
                                <td class="ourStudentTableTd"><?=$countPay++?></td>
                                <td class="ourStudentTableTd ourStudentTableTdStudentPay"><?=
                                getOneSrudentForId($link, $ourPayItem['idStudent'])['name'].' '.getOneSrudentForId($link, $ourPayItem['idStudent'])['sername'];
                                ?></td>
                                <td class="idStudentThis" style="display:none;"><?=$ourPayItem['idStudent'];?></td>
                                <td class="ourStudentTableTd ourStudentTableTdDatePay"><?=$ourPayItem['datePay'];?></td>
                                <td class="ourStudentTableTd ourStudentTableTdPricePay"><?=$ourPayItem['pricePay'];?></td>
                                <td class="ourStudentTableTd ourStudentTableTdCommentPay"><?=$ourPayItem['commentPay'];?></td>
                            </tr>
                            <?
                        }
                    ?>
                    </table>
                </div>






            </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/footer.php"); ?>