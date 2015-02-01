{{ BootForm::text('Name', 'milestone[name]')->placeholder('Name') }}
{{ BootForm::textarea('Short Description', 'milestone[short]')->placeholder('Short Description')->attribute('maxlength', 256)->attribute('rows', 3) }}
{{ BootForm::textarea('Full Text', 'milestone[text]')->placeholder('Full Text') }}

<hr />

<h2>What does it do?</h2>

<div class="drawer">
    {{ BootForm::checkbox('It awards an ability.', 'rewards_ability')->attribute('class', 'drawer-toggle') }}
    <div class="drawer-target">
        {{ BootForm::textarea('Ability Short Description', 'ability[short]')->placeholder('Ability Short Description')->attribute('maxlength', 256)->attribute('rows', 3) }}
        {{ BootForm::select('Targets', 'targets[]')->attribute('multiple', true)->options($targetOptions) }}
        {{ BootForm::select('Ranges', 'ranges[]')->attribute('multiple', true)->options($rangeOptions) }}
        {{ BootForm::select('Attunements', 'attunements[]')->attribute('multiple', true)->options($attunementOptions) }}
    </div>
</div>

<div class="drawer">
    {{ BootForm::checkbox('It awards an attribute modifier.', 'rewards_attribute')->attribute('class', 'drawer-toggle') }}
    <div class="drawer-target">
        <div class="clone-container">
            <div class="clone-target row">
                <div class="col-sm-9">
                    {{ BootForm::select('Attribute', 'attribute_modifier[id][]')->attribute('id', 'attribute')->options(array_merge(array('' => 'Choose Attribute...'), $attributeModifierOptions)) }}
                </div>
                <div class="col-sm-2 large-text">
                    {{ BootForm::text('Attribute Modifier', 'attribute_modifier[mod][]')->attribute('id', 'attribute_modifier')->placeholder('Mod Num') }}
                </div>
                <div class="col-sm-1 large-text">
                    <i class="fa fa-plus-circle clone"></i>
                    <i class="fa fa-minus-circle delete"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<hr />


