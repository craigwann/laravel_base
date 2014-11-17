{{ BootForm::text('First Name', 'user_first_name')->placeholder('First Name') }}
{{ BootForm::text('Last Name', 'user_last_name')->placeholder('Last Name') }}
{{ BootForm::email('Email', 'email')->placeholder('Email') }}
{{ BootForm::text('Username', 'user_username')->placeholder('Username') }}
{{ BootForm::select('Type', 'user_type_id')->options(array_merge(['' =>  'Choose User Type...'], $user_type_options))->select('') }}
{{ BootForm::password('Password', 'password')->placeholder('Password') }}
{{ BootForm::password('Confirm Password', 'password_confirmation')->placeholder('Confirm Password') }}
{{ BootForm::select('Active', 'user_active')->options(['' => 'Choose Status', true => 'Active', false => 'Inactive'])->select(true) }}
