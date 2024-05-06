<?php
namespace App\Card;

class CardGraphic extends Card
{
    private $representation = [
        '🂡',
        '🂢',
        '🂣',
        '🂤',
        '🂥',
        '🂦',
        '🂧',
        '🂨',
        '🂩',
        '🂪',
        '🂫',
        '🂭',
        '🂮',
        '🂱',
        '🂲',
        '🂳',
        '🂴',
        '🂵',
        '🂶',
        '🂷',
        '🂸',
        '🂹',
        '🂺',
        '🂻',
        '🂽',
        '🂾',
        '🃁',
        '🃂',
        '🃃',
        '🃄',
        '🃅',
        '🃆',
        '🃇',
        '🃈',
        '🃉',
        '🃊',
        '🃋',
        '🃍',
        '🃎',
        '🃑',
        '🃒',
        '🃓',
        '🃔',
        '🃕',
        '🃖',
        '🃗',
        '🃘',
        '🃙',
        '🃚',
        '🃛',
        '🃝',
        '🃞',


        
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getPrint(): Array
    {
        return [$this->representation[$this->getValue() + ($this->getSuitIndex() * 13) - 1]];
    }
}