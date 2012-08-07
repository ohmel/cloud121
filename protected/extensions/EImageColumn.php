<?php

/**
 * EImageColumn
 *
 * Allows to display image in CGridView column.
 *
 * @author Alexander Makarov
 *
 * @version 1.1
 *
 */
Yii::import('zii.widgets.grid.CGridColumn');

class EImageColumn extends CGridColumn {

    /**
     * @var array the HTML options for the data cell tags.
     */
    public $htmlOptions = array('class' => 'image-column');

    /**
     * @var array the HTML options for the header cell tag.
     */
    public $headerHtmlOptions = array('class' => 'image-column');

    /**
     * @var array the HTML options for the footer cell tag.
     */
    public $footerHtmlOptions = array('class' => 'image-column');

    /**
     * @var array the HTML options for the image tag.
     */
    public $imageOptions = array();

    /**
     * @var string a PHP expression that is evaluated for every data cell and whose result
     * is used as the path to image. In this expression, the variable
     * <code>$row</code> the row number (zero-based); <code>$data</code> the data model for the row;
     * and <code>$this</code> the column object.
     */
    public $imagePathExpression = array();

    /**
     * @var string Text that is used if cell is empty.
     */
    public $emptyText = '';

    /**
     * Renders the data cell content.
     * @param integer the row number (zero-based)
     * @param mixed the data associated with the row
     */
    protected function renderDataCellContent($row, $data) {
        $content = $this->emptyText;
//        print_r(count($this->imagePathExpression));exit;
        for($i=0;$i<count($this->imagePathExpression);$i++) {
            if ($this->imagePathExpression[$i] !== null && $imagePath = $this->evaluateExpression($this->imagePathExpression[$i], array('row' => $row, 'data' => $data))) {
                $this->imageOptions['src'] = $imagePath;
                $contentimg = CHtml::tag('img', $this->imageOptions);
                if($i == 0){
                    $lnk = $data->fb_account;
                }
                if($i == 1){
                    $lnk = $data->twitter_account;
                }
                if($i == 2){
                    $lnk = $data->youtube_account;
                }
                $content .= "<a href='$lnk'>$contentimg</a>";
            }
        }
        echo $content;
    }

}
