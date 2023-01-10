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

    'accepted' => ':attribute phải được chấp nhận.',
    'accepted_if' => ':attribute phải được chấp nhận khi trường :other là :value.',
    'active_url' => ':attribute không phải URL hợp lệ.',
    'after' => ':attribute phải diễn ra sau ngày :date.',
    'after_or_equal' => ':attribute phải diễn ra cùng hoặc sau ngày :date.',
    'alpha' => ':attribute chỉ chứa kí tự.',
    'alpha_dash' => ':attribute chỉ chứa kí tự, số, gạch chéo, và gạch dưới.',
    'alpha_num' => ':attribute chỉ chứa kí tự và số.',
    'array' => ':attribute phải là mảng.',
    'before' => ':attribute phải diễn ra trước ngày :date.',
    'before_or_equal' => ':attribute phải diễn ra cùng hoặc trước ngày :date.',
    'between' => [
        'numeric' => ':attribute phải nằm giữa :min và :max.',
        'file' => ':attribute phải có dung lượng nằm trong khoảng :min và :max kilobytes.',
        'string' => ':attribute phải có độ dài nằm trong khoảng :min và :max characters.',
        'array' => ':attribute phải có số phẩn tử :min và :max phần tử.',
    ],
    'boolean' => ':attribute field phải là true hoặc false.',
    'confirmed' => ':attribute confirmation does not match.',
    'current_password' => 'password không chính xác.',
    'date' => ':attribute không phải ngày hợp lệ.',
    'date_equals' => ':attribute phải trùng ngày :date.',
    'date_format' => ':attribute phải là ngày có dịnh dạng :format.',
    'declined' => ':attribute phải là từ chối.',
    'declined_if' => ':attribute phải là từ chối khi :other là :value.',
    'different' => ':attribute và :other phải khác nhau.',
    'digits' => ':attribute phải có :digits chữ số.',
    'digits_between' => ':attribute phải có số chữ số nằm trong khoảng :min và :max digits.',
    'dimensions' => ':attribute có kích thước không hợp lệ.',
    'distinct' => ':attribute có 2 giá trị giống nhau.',
    'email' => ':attribute phải là email hợp lệ.',
    'ends_with' => ':attribute phải kết thúc bằng một trong các chữ sau: :values.',
    'enum' => ':attribute được chọn không hợp lệ.',
    'exists' => ':attribute được chọn không hợp lệ.',
    'file' => ':attribute phải là một file.',
    'filled' => ':attribute không được để trống.',
    'gt' => [
        'numeric' => ':attribute phải lớn hơn :value.',
        'file' => ':attribute phải có dung lượng lớn hơn :value KB.',
        'string' => ':attribute phải có nhiều hơn :value kí tự.',
        'array' => ':attribute phải có nhiều hơn :value phần tử.',
    ],
    'gte' => [
        'numeric' => ':attribute phải lớn hoặc hoặc bằng :value.',
        'file' => ':attribute phải có dung lượng lớn hơn hoặc bằng :value KB.',
        'string' => ':attribute phải có số kí tự nhiều hơn hoặc bằng :value kí tự.',
        'array' => ':attribute phải có :value phần tử hoặc nhiều hơn.',
    ],
    'image' => ':attribute phải là một hình ảnh.',
    'in' => ':attribute được chọn không hợp lệ.',
    'in_array' => ':attribute không tồn tại trong :other.',
    'integer' => ':attribute phải là một só nguyên.',
    'ip' => ':attribute phải là địa chỉ IP.',
    'ipv4' => ':attribute phải là địa chỉ IPv4.',
    'ipv6' => ':attribute phải là địa chỉ IPv6.',
    'json' => ':attribute phải phải là chuỗi kí tự JSON.',
    'lt' => [
        'numeric' => ':attribute phải ít hơn :value.',
        'file' => ':attribute phải có dung lượng nhỏ hơn :value KB.',
        'string' => ':attribute phải là chứa ít hơn :value kí tự.',
        'array' => ':attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => ':attribute phải là less than hoặc equal to :value.',
        'file' => ':attribute phải là less than hoặc equal to :value kilobytes.',
        'string' => ':attribute phải là less than hoặc equal to :value characters.',
        'array' => ':attribute must not have more than :value items.',
    ],
    'mac_address' => ':attribute phải là a valid MAC address.',
    'max' => [
        'numeric' => ':attribute must not be greater than :max.',
        'file' => ':attribute must not be greater than :max kilobytes.',
        'string' => ':attribute must not be greater than :max characters.',
        'array' => ':attribute must not have more than :max items.',
    ],
    'mimes' => ':attribute phải là a file of type: :values.',
    'mimetypes' => ':attribute phải là a file of type: :values.',
    'min' => [
        'numeric' => ':attribute có ít nhất :min.',
        'file' => ':attribute phải lớn ít nhất :min KB.',
        'string' => ':attribute phải chứa ít nhất :min kí tự.',
        'array' => ':attribute phải có ít nhất :min phần tử.',
    ],
    'multiple_of' => ':attribute phải là a multiple of :value.',
    'not_in' => ':attribute được chọn không hợp lệ.',
    'not_regex' => ':attribute format is invalid.',
    'numeric' => ':attribute phải là số.',
    'password' => 'password không chính xác.',
    'present' => ':attribute field phải là present.',
    'prohibited' => ':attribute field is prohibited.',
    'prohibited_if' => ':attribute field is prohibited when :other is :value.',
    'prohibited_unless' => ':attribute field is prohibited unless :other is in :values.',
    'prohibits' => ':attribute field prohibits :other from being present.',
    'regex' => ':attribute định dạng không hợp lệ.',
    'required' => ':attribute không được để trống.',
    'required_array_keys' => ':attribute field must contain entries for: :values.',
    'required_if' => ':attribute không được để trống when :other is :value.',
    'required_unless' => ':attribute không được để trống unless :other is in :values.',
    'required_with' => ':attribute không được để trống when :values is present.',
    'required_with_all' => ':attribute không được để trống when :values are present.',
    'required_without' => ':attribute không được để trống when :values không được hiển thị.',
    'required_without_all' => ':attribute không được để trống when none of :values are present.',
    'same' => ':attribute và :other phải giống nhau.',
    'size' => [
        'numeric' => ':attribute phải là :size.',
        'file' => ':attribute phải là :size KB.',
        'string' => ':attribute phải là :size kí tự.',
        'array' => ':attribute phải chứa :size phần tử.',
    ],
    'starts_with' => ':attribute bắt đầu bằng một trong các từ sau: :values.',
    'string' => ':attribute phải là chuỗi kí tự.',
    'timezone' => ':attribute phải là timezone hợp lệ.',
    'unique' => ':attribute đã tồn tại.',
    'uploaded' => ':attribute bị tải lên thất bại.',
    'url' => ':attribute phải là URL hợp lệ.',
    'uuid' => ':attribute phải là UUID hợp lệ.',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'Tên',
        'phone' => 'Số điện thoại',
        'address' => 'Địa chỉ',
        'password' => 'Mật khẩu'
    ],

];
