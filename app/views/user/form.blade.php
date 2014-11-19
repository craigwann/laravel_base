{{ BootForm::text('First Name', 'first_name')->placeholder('First Name') }}
{{ BootForm::text('Last Name', 'last_name')->placeholder('Last Name') }}
{{ BootForm::email('Email', 'email')->placeholder('Email') }}
{{ BootForm::text('Username', 'username')->placeholder('Username') }}
{{ BootForm::select('Type', 'user_type_id')->options($user_type_options)->select('') }}
{{ BootForm::password('Password', 'password')->placeholder('Password') }}
{{ BootForm::password('Confirm Password', 'password_confirmation')->placeholder('Confirm Password') }}
{{ BootForm::select('Active', 'active')->options([true => 'Active', false => 'Inactive'])->select(true) }}
