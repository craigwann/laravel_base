{{ BootForm::text('Name', 'name')->placeholder('Name') }}
{{ BootForm::textarea('Short Description', 'short')->placeholder('Short Description')->attribute('maxlength', 256)->attribute('rows', 3) }}
{{ BootForm::textarea('Full Text', 'text')->placeholder('Full Text') }}

<h2>What does it do?</h2>

<div class="drawer">
    {{ BootForm::checkbox('Does the Milestone reward an ability?', 'rewards_ability')->attribute('class', 'drawer-toggle') }}
    <div class="drawer-target">Rewards an ability</div>
</div>

<div class="drawer">
    {{ BootForm::checkbox('Does the Milestone reward an attribute modifier?', 'rewards_attribute')->attribute('class', 'drawer-toggle') }}
    <div class="drawer-target">Rewards an attribute</div>
</div>