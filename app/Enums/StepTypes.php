<?php

namespace App\Enums;

enum StepTypes: string
{
    use HasValues;

    case STEP = 'step';
    case OPTION = 'option';
}
