<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/header.php"); ?>
<?php include $_SERVER['DOCUMENT_ROOT'].("/templates/nav.php"); ?>
        <div class="rightMainWrap">
            <div class="wrapperPay">
                <div class="wrapperPayNewPay">
                    <p class="wrapperPayNewPayTitile">Новый расход</p>
                    <div class="wrapperPayNewPayFlex">
                        <input type="date"  class="inputNewPerson inputPayDate inputNewPersonDateTrial">
                        <input type="text"  class="inputNewPerson inputPayPrice inputNewPersonDateTrial inputNewPersonDateTrialPrice" placeholder="Cумма, руб">
                        <input type="text"  class="inputNewPerson inputPayComment inputNewPersonDateTrial inputNewPersonDateTrialComment" placeholder="Комментарий">
                        <a onclick="getNewCost()" class="buttonNewPerson buttonNewPersonPay">Добавить</a>
                    </div>
                </div>
                <div class="wrapperPayNewPay wrapperPayNewPayChange searchResultAjaxIdStudent">
                    <p class="wrapperPayNewPayTitile">Изменить расход</p>
                    <div class="wrapperPayNewPayFlex">
                        <input type="date"  class="inputNewPerson inputPayDateСhange inputNewPersonDateTrial">
                        <input type="text"  class="payIdOperation" style="display:none;">
                        <input type="text"  class="inputNewPerson inputPayPriceСhange inputNewPersonDateTrial inputNewPersonDateTrialPrice" placeholder="Cумма, руб">
                        <input type="text"  class="inputNewPerson inputPayCommentСhange inputNewPersonDateTrial inputNewPersonDateTrialComment" placeholder="Комментарий">
                        <a onclick="setCostСhange()" alt="" class="buttonNewPerson buttonNewPersonPay buttonNewPersonPayChange">Изменить</a>
                        <a onclick="setCostСhangeDelete()" class="buttonNewPerson buttonNewPersonPay buttonNewPersonPayDelete">Удалить</a>
                    </div>
                </div>
                <div class="taplePay">
                    <table class="ourStudentTable ourStudentTablePay">
                    <tr class="ourStudentTableTr ourStudentTableTrTitle">
                        <td class="ourStudentTableTd ourStudentTableTdTitle">№</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Дата</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle">Сумма</td>
                        <td class="ourStudentTableTd ourStudentTableTdTitle ourStudentTableTdTitleComment">Комментарий</td>
                    </tr>
                    <?
                        $ourCosts = getAll($link,'costs');
                        $countCost=1;
                        foreach($ourCosts as $ourCostsItem){
                            ?>
                            <tr class="ourStudentTableTr ourStudentTableTrTitlePay" title="<?=$ourCostsItem['id'];?>" onclick="changeCost(this)">
                                <td class="ourStudentTableTd"><?=$countCost++?></td>
                                <td class="ourStudentTableTd ourStudentTableTdDatePay"><?=$ourCostsItem['date'];?></td>
                                <td class="ourStudentTableTd ourStudentTableTdPricePay"><?=$ourCostsItem['price'];?></td>
                                <td class="ourStudentTableTd ourStudentTableTdCommentPay"><?=$ourCostsItem['comment'];?></td>
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