<?php
namespace App\Lib;

class LotLayout
{
    protected $product;
    protected $section;
    protected $totalRow;
    protected $levelNumber;
    protected $lotNumber;
    public $lotLayouts;

    public function __construct($product)
    {
        $this->product = $product;
        $this->section = $product->bookingSection;
        $this->lotLayouts = $this->lotLayouts();
    }

    public function lotLayouts()
    {
        $lotLayout = explode('x', str_replace(' ','', $this->section->seat_layout));
        $layout['left'] = $lotLayout[0];
        $layout['right'] = $lotLayout[1];
        return (object)$layout;
    }

    public function getDeckHeader($levelNumber)
    {
        $html = '
            <span class="front"></span>
            <span class="rear"></span>
        ';
        if ($levelNumber == 0) {
            $html .= '
                <span class="lower"></span>
            ';
        } else {
            $html .= '<span class="driver">Deck :  '.($levelNumber+1) .'</span>';
        }
        return $html;
    }

    public function getLots($levelNumber,$lotNumber)
    {
        $this->levelNumber = $levelNumber;
        $this->lotNumber = $lotNumber;
        $lots = [
            'left'=>$this->leftLots(),
            'right'=>$this->rightLots(),
        ];
        return (object)$lots;
    }

    protected function leftLots()
    {
        $html = '<div class="left-side">';
        $lotData = '';

        for ($i = 1; $i <= $this->lotLayouts->left; $i++)
        {
            $lotData .= $this->generateLots($i);
        }

        $html .= $lotData;
        $html .=  '</div>';
        return $html;
    }

    protected function rightLots()
    {
        $html = '<div class="right-side">';
        $lotData = '';

        for ($i = 1; $i <= $this->lotLayouts->right; $i++)
        {
            $lotData .= $this->generateLots($i + $this->lotLayouts->left);
        }

        $html .= $lotData;
        $html .=  '</div>';
        return $html;
    }

    public function generateLots($loopIndex, $levelNumber = null, $lotNumber = null)
    {
        $levelNumber = $levelNumber ?? $this->levelNumber;
        $lotNumber = $lotNumber ?? $this->lotNumber;
        return "<div>
                    <span class='seat' data-seat='".($levelNumber .'-'. $lotNumber.''.$loopIndex) ."'>
                        $this->lotNumber$loopIndex
                        <span></span>
                    </span>
                </div>";
    }

    public function getTotalRow($seat)
    {
        $rowItem    = $this->lotLayouts->left + $this->lotLayouts->right;
        $totalRow   = floor ($seat / $rowItem);
        $this->totalRow = $totalRow;
        return $this->totalRow;
    }

    public function getLastRowSit($seat)
    {
        $rowItem = $this->lotLayouts->left + $this->lotLayouts->right;
        $lastRowSeat = $seat - $this->getTotalRow($seat) * $rowItem;
        return $lastRowSeat;
    }
}
