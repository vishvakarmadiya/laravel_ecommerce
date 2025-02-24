<?php

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity', 'price'];
}
