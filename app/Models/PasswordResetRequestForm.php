<?php

namespace App\Models;

use Yii;
use common\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends \App\Components\BaseModel
{

    protected $validationRules = [
        'email' => 'trim|required|valid_email'
    ];

    protected $fieldLabels = [
        'email' => 'Email'
    ];
 


    /*
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }
    */


    /*


        /* @var $user User */

        /*
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }
        
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject()
            ->send();
        */

        //'Sorry, we are unable to reset password for the provided email address.'    


    */

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail(User $user, &$error = null)
    {    
        $message = view('messages/passwordReset', [
            'user' => $user,
            'resetLink' => site_url('user/resetPassword/' . $user->user_password_reset_token)
        ]);

        return service('mailer')->sendToUser(
            $user,
            'Password reset for ' . base_url(),
            $message,
            $error
        );
    }
}
