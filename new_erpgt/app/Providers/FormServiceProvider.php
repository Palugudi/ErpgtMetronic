<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
        Form::component('bsBtnSlider', 'components.form.button_slider', ['name', 'image']);
        Form::component('bsCheckbox', 'components.form.checkbox', ['name', 'translation', 'label', 'value', 'attributes']);
        Form::component('bsCheckboxChecked', 'components.form.checkbox_checked', ['name', 'translation', 'label', 'value', 'attributes']);
        Form::component('bsDatetimepicker', 'components.form.datetimepicker', ['name', 'translation', 'value', 'attributes']);
        Form::component('bsEmail', 'components.form.email', ['name', 'translation', 'value', 'attributes']);
        Form::component('bsFile', 'components.form.file', ['name', 'translation', 'attributes']);
        Form::component('bsGender', 'components.form.gender', ['name', 'translation']);
        Form::component('bsNumber', 'components.form.number', ['name', 'translation', 'value', 'attributes']);
        Form::component('bsPassword', 'components.form.password', ['name', 'translation', 'attributes']);
        Form::component('bsRadio', 'components.form.radio', ['name', 'translation', 'label', 'value', 'attributes']);
        Form::component('bsRadioChecked', 'components.form.radio_checked', ['name', 'translation', 'label', 'value', 'attributes']);
        Form::component('bsSelect', 'components.form.select', ['name', 'translation', 'data']);
        Form::component('bsSelectnorequire', 'components.form.selectnorequire', ['name', 'translation', 'data']);
        Form::component('bsSelectMultiple', 'components.form.select_multiple', ['name', 'translation', 'data']);
        Form::component('bsSelectSelected', 'components.form.select_selected', ['name', 'translation', 'data', 'selected']);
        Form::component('bsSubmit', 'components.form.submit', ['name', 'translation', 'attributes']);
        Form::component('bsText', 'components.form.text', ['name', 'translation', 'value', 'attributes']);
        Form::component('bsTextarea', 'components.form.textarea', ['name', 'translation', 'value', 'attributes']);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
