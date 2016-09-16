<?php
$this->title='گزارش اضافه کاری';
use yii\helpers\Html;
use hoomanMirghasemi\jdf\Jdf;

?>
<div class="row">
    <div class="col-lg-12">
        <h2>زمان ورود و خروج</h2>
        <p>در این جدول ۷ درخواست اضافه کاری  شما را نشان میدهد،</p>
        <p><?= Jdf::jdate('امروز: l، j F'); ?></p>
        <table class="table table-hover table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>زمان ثبت</th>
                <th>زمان ورود</th>
                <th>زمان خروج</th>
                <th>محل خدمت</th>
                <th>وضعیت تایید</th>
                <th>توضیحات</th>

            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            <?php foreach ($Omodel as $value) { ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= Jdf::jdate('H:i:s - Y/m/d',$value->record_time); ?></td>
                    <td><?= Jdf::jdate('H:i:s - Y/m/d', $value->hours->login); ?></td>
                    <td><?= Jdf::jdate('H:i:s - Y/m/d', $value->hours->logout); ?></td>
                    <td><?= $value->location ?></td>
                    <td><?= $value->getVerfiy() ?></td>
                    <td><?= $value->description ?></td>


                </tr>
                <?php $i++; ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-6">
