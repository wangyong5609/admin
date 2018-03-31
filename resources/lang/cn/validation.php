<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'accepted'             => '必须接受 :attribute.',
    'active_url'           => '字段 :attribute 不是合法的URL地址.',
    'after'                => '字段 :attribute 必须晚于 :date.',
    'after_or_equal'       => '字段 :attribute 必须晚于或者等于 :date.',
    'alpha'                => '字段 :attribute 只能包括字母.',
    'alpha_dash'           => '字段 :attribute 只能由字母、数字以及短横线组成.',
    'alpha_num'            => '字段 :attribute 只能由字母和数字组成.',
    'array'                => '字段 :attribute 必须是一个列表.',
    'before'               => '字段 :attribute 必须早于 :date.',
    'before_or_equal'      => '字段 :attribute 必须早于或者等于 :date.',
    'between'              => [
        'numeric' => '字段 :attribute 必须在 :min 和 :max 之间.',
        'file'    => ':attribute 大小必须在 :min KB 到 :max KB之间.',
        'string'  => ':attribute 的长度必须在 :min 到 :max 个字符之间.',
        'array'   => ':attribute 必须包括 :min 到 :max 个子条目.',
    ],
    'boolean'              => '字段 :attribute 只能是“是”或“否”.',
    'confirmed'            => ':attribute 两次输入不一致.',
    'date'                 => ':attribute 不是一个正确的日期格式.',
    'date_format'          => ':attribute 的格式不满足 :format.',
    'different'            => ':attribute 的内容不能与 :other 相同.',
    'digits'               => ':attribute 必须是 :digits 个数字.',
    'digits_between'       => ':attribute 只能是 :min 到 :max 个数字组成.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => '字段 :attribute 有重复值.',
    'email'                => ':attribute 不是正确的邮件地址.',
    'exists'               => '选择的 :attribute 不正确.',
    'file'                 => ':attribute 必须是一个文件.',
    'filled'               => '字段 :attribute 不能为空.',
    'image'                => ':attribute 只能是一个图片.',
    'in'                   => '选择的 :attribute 不正确.',
    'in_array'             => '字段 :attribute 在 :other 中不存在.',
    'integer'              => ':attribute 必须是整数.',
    'ip'                   => ':attribute 不是正确的IP地址格式.',
    'json'                 => ':attribute 必须是正确的JSON字符串格式.',
    'max'                  => [
        'numeric' => ':attribute 不能大于 :max.',
        'file'    => ':attribute 不能大于 :max KB.',
        'string'  => ':attribute 的长度不能多于 :max 个字符.',
        'array'   => ':attribute 不能多于 :max 个子条目.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => ':attribute 不能小于 :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => ':attribute 的长度不能小于 :min 个字符.',
        'array'   => ':attribute 不能小于 :min 个子条目.',
    ],
    'not_in'               => '选择的 :attribute 不正确.',
    'numeric'              => ':attribute 必须是数字.',
    'present'              => '字段 :attribute 必须存在.',
    'regex'                => ':attribute 的格式不正确.',
    'required'             => ':attribute 不能为空.',
    'required_if'          => '当 :other 为 :values 时，:attribute 不能为空.',
    'required_unless'      => '除非 :other 在 :values 范围以内，否则 :attribute 不能为空.',
    'required_with'        => '当 :values 存在时，:attribute 不能为空.',
    'required_with_all'    => '当 :values 存在时，:attribute 不能为空.',
    'required_without'     => '当 :values 不存在时，:attribute 不能为空。',
    'required_without_all' => '当 :values 中的任何值都不存在时，:attribute 不能为空.',
    'same'                 => ':attribute 和 :other 必须一致.',
    'size'                 => [
        'numeric' => ':attribute 必须是 :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => ':attribute 的长度必须为 :size 个字符.',
        'array'   => ':attribute 必须包括 :size 个子条目.',
    ],
    'string'               => ':attribute 必须是字符串.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => '同名 :attribute 已经被占用.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => ':attribute 格式错误.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom' => [
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        'password' => '密码',
        'username' => '用户名',
    ],
];