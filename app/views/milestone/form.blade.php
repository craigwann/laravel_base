{{ BootForm::text('Name', 'name')->placeholder('Name') }}
{{ BootForm::textarea('Short Description', 'short')->placeholder('Short Description')->attribute('maxlength', 256)->attribute('rows', 3) }}
{{ BootForm::textarea('Full Text', 'text')->placeholder('Full Text') }}
