<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2018 Power Kernel
 */

/* @var $this yii\web\View */
/* @var $model \powerkernel\yiiauth\models\Auth */

?>

<span class="preheader"><?= Yii::t('auth', '{CODE} is your verification code.', ['CODE' => $model->code]) ?></span>
<table class="main" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td class="alert alert-primary">
            <?= Yii::t('auth', 'Verification') ?>
        </td>
    </tr>
    <tr>
        <td class="content-wrap">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="content-block">
                        <?= Yii::t('auth', 'Hello,') ?>
                    </td>
                </tr>
                <tr>
                    <td class="content-block">
                        <?= Yii::t('auth', 'Your verification code is: {CODE}', ['CODE' => $model->code]) ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<link href="src/styles.css" media="all" rel="stylesheet" type="text/css"/>