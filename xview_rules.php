<?php

namespace Brace;

class xViewRules{
    private $rules = [];

    private $combinator = 'and';

    public function __construct($field, $value, $operator = '$e'){
        $this->add($field, $value, $operator, 'and');
    }

    public function add($field, $value = null, $operator = '$e', $combinator = 'add'){
        if($field instanceof xViewRules){
            $this->rules[] = $field->toArray();
        } else {
            $this->rules[] = [
                'field'    => $field,
                'value'    => $value,
                'operator' => $operator
            ];
        }

        $this->combinator = $combinator;

        return $this;
    }

    public function and($field, $value = null, $operator = '$e'){
        return $this->add($field, $value, $operator, 'and');
    }

    public function or($field, $value = null, $operator = '$e'){
        return $this->add($field, $value, $operator, 'or');
    }

    public function toArray(){
        return [
            'rules'      => $this->rules,
            'combinator' => $this->combinator
        ];
    }

    public function toJSON(){
        return json_encode($this->toArray());
    }

    public function toBase64(){
        return base64_encode($this->toJSON());
    }
}

function xViewRules($field, $value, $operator = '$e', $combinator = 'and'){
    return new xViewRules($field, $value, $operator, $combinator);
}

var_dump(xViewRules('id', 5)->toJSON());

var_dump(xViewRules('id', 5)->and('name', 'George')->and('age', 20, '$gt')->toJSON());

var_dump(xViewRules('id', 5)->or(xViewRules('firstName', 'George')->and('lastName', 'Batt'))->toJSON());

var_dump(xViewRules('id', 5)->and(xViewRules('firstName', 'George')->or('lastName', 'Batt'))->toJSON());