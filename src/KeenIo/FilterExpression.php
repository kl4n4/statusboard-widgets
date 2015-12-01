<?php

namespace KeenIo;

class FilterExpression {

    const OP_EQ = 'eq';

    /**
     * @var string $operator
     */
    protected $operator;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $value
     */
    protected $value;

    public function toArray() {
        return array(
            'property_name' => $this->getName(),
            'operator' => $this->getOperator(),
            'property_value' => $this->getValue(),
        );
    }

    /**
     * @return string
     */
    public function getOperator() {
        return $this->operator;
    }

    /**
     * @param string $operator
     * @return $this
     */
    public function setOperator($operator) {
        $this->operator = $operator;
        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

}
