<?php

return [

    'required'    => ':attributeを入力してください',
    'email'       => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
    'string'      => ':attributeは文字列で入力してください',
    'numeric'     => ':attributeは数値で入力してください',
    'integer'     => ':attributeは整数で入力してください',
    'date'        => ':attributeは有効な日付で入力してください',
    'date_format' => ':attributeは:format形式で入力してください',
    'between'     => [
        'numeric' => ':attributeは:min〜:maxの範囲で入力してください',
    ],
    'max' => [
        'numeric' => ':attributeは:max以下で入力してください',
        'string'  => ':attributeは:max文字以内で入力してください',
    ],
    'min' => [
        'numeric' => ':attributeは:min以上で入力してください',
        'string'  => ':attributeは:min文字以上で入力してください',
    ],
    'confirmed' => ':attributeが一致しません',

    'attributes' => [
        'email'           => 'メールアドレス',
        'password'        => 'パスワード',
        'name'            => 'お名前',
        'date'            => '日付',
        'weight'          => '体重',
        'target_weight'   => '目標の体重',
        'calories'        => '摂取カロリー',
        'exercise_time'   => '運動時間',
        'exercise_content'=> '運動内容',
    ],
];
