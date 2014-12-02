{{ BootForm::text('Name', 'name')->placeholder('Name') }}
{{ BootForm::textarea('Short Description', 'short')->placeholder('Short Description')->attribute('maxlength', 256)->attribute('rows', 3) }}
{{ BootForm::textarea('Full Text', 'text')->placeholder('Full Text') }}

<hr />

<h2>What does it do?</h2>

<div class="drawer">
    {{ BootForm::checkbox('It awards an ability.', 'rewards_ability')->attribute('class', 'drawer-toggle') }}
    <div class="drawer-target">
        <div class="clone-container">
            <div class="clone-target row">
                <div class="col-sm-11">
                    {{ BootForm::select('Ability', 'ability_id[]')->attribute('id', 'ability_id')->options(array('' => 'Choose Ability...')) }}
                </div>
                <div class="col-sm-1 large-text">
                    <i class="fa fa-plus-circle clone"></i>
                    <i class="fa fa-minus-circle delete"></i>
                </div>
            </div>
        </div>


    </div>
</div>

<div class="drawer">
    {{ BootForm::checkbox('It awards an attribute modifier.', 'rewards_attribute')->attribute('class', 'drawer-toggle') }}
    <div class="drawer-target">
        {{ BootForm::text('Strength', 'ability_modifier[strength]')->placeholder('Strength') }}
        {{ BootForm::text('Personality', 'ability_modifier[personality]')->placeholder('Personality') }}
        {{ BootForm::text('Agility', 'ability_modifier[agility]')->placeholder('Agility') }}
        {{ BootForm::text('Discipline', 'ability_modifier[discipline]')->placeholder('Discipline') }}
        {{ BootForm::text('Endurance', 'ability_modifier[endurance]')->placeholder('Endurance') }}
        {{ BootForm::text('Smarts', 'ability_modifier[smarts]')->placeholder('Smarts') }}
        {{ BootForm::text('Health', 'ability_modifier[health]')->placeholder('Health') }}
        {{ BootForm::text('Sanity', 'ability_modifier[sanity]')->placeholder('Sanity') }}
        {{ BootForm::text('Stamina', 'ability_modifier[stamina]')->placeholder('Stamina') }}
        {{ BootForm::text('Stress', 'ability_modifier[stress]')->placeholder('Stress') }}
        {{ BootForm::text('Strain', 'ability_modifier[strain]')->placeholder('Strain') }}
        {{ BootForm::text('Fat', 'ability_modifier[fat]')->placeholder('Fat') }}
    </div>
</div>