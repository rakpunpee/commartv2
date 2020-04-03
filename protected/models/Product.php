<?php

/**
 * This is the model class for table "impproduct".
 *
 * The followings are the available columns in table 'impproduct':
 * @property string $Product
 * @property string $SUPPLIERCO
 * @property string $Name
 * @property string $Unit
 * @property string $MDisType
 * @property string $MDisValue
 * @property string $VAT
 * @property string $PRODUCTTYP
 * @property string $CATEGORYID
 * @property string $subcategory
 * @property string $Brand
 * @property string $Model
 * @property string $SPECIFICAT
 * @property string $Info1
 * @property string $Info2
 * @property string $Info3
 * @property string $Info4
 * @property string $Info5
 * @property string $Info6
 * @property string $Info7
 * @property string $Info8
 * @property string $PMID
 * @property string $EOL
 * @property string $NoPrint
 * @property string $PrintPrice
 * @property string $Percent3
 * @property string $Percent6
 * @property string $Percent12
 * @property string $LeadTime
 * @property string $DrAcc
 * @property string $CrAcc
 * @property string $Weight
 * @property string $ESTIMATEP
 * @property string $DutyP
 * @property string $Status
 * @property string $chk
 * @property string $productcode
 * @property string $del
 * @property string $effdate
 * @property string $grade
 * @property string $lastpo
 * @property integer $lastponum
 * @property integer $newstatus
 * @property string $newstartdate
 * @property integer $lockproduct
 * @property integer $locknum
 * @property integer $autogen
 * @property string $procomment
 * @property integer $reserve
 * @property string $shortage
 * @property string $upd
 */
class Product extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'impproduct';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Product, SUPPLIERCO, Name, Unit, MDisType, MDisValue, VAT, PRODUCTTYP, CATEGORYID, Brand, Model, SPECIFICAT, Info1, Info2, Info3, Info4, Info5, Info6, PMID, NoPrint, PrintPrice, Percent3, Percent6, Percent12, LeadTime, DrAcc, CrAcc, Weight, ESTIMATEP, DutyP, Status, chk, productcode, del, effdate, grade, upd', 'required'),
            array('lastponum, newstatus, lockproduct, locknum, autogen, reserve', 'numerical', 'integerOnly' => true),
            array('Product, SUPPLIERCO, Unit, MDisType, MDisValue, PRODUCTTYP, CATEGORYID, subcategory, Brand, SPECIFICAT, Info1, Info2, Info3, Info4, Info5, Info6, Info7, Info8, PMID, EOL, NoPrint, PrintPrice, Percent3, Percent6, Percent12, LeadTime, DrAcc, CrAcc, Weight, ESTIMATEP, DutyP, Status, productcode, grade', 'length', 'max' => 45),
            array('Name, Model, procomment', 'length', 'max' => 250),
            array('VAT', 'length', 'max' => 9),
            array('chk, del', 'length', 'max' => 1),
            array('lastpo, newstartdate, shortage', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Product, SUPPLIERCO, Name, Unit, MDisType, MDisValue, VAT, PRODUCTTYP, CATEGORYID, subcategory, Brand, Model, SPECIFICAT, Info1, Info2, Info3, Info4, Info5, Info6, Info7, Info8, PMID, EOL, NoPrint, PrintPrice, Percent3, Percent6, Percent12, LeadTime, DrAcc, CrAcc, Weight, ESTIMATEP, DutyP, Status, chk, productcode, del, effdate, grade, lastpo, lastponum, newstatus, newstartdate, lockproduct, locknum, autogen, procomment, reserve, shortage, upd', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'Product' => 'Product',
            'SUPPLIERCO' => 'Supplierco',
            'Name' => 'Name',
            'Unit' => 'Unit',
            'MDisType' => 'Mdis Type',
            'MDisValue' => 'Mdis Value',
            'VAT' => 'Vat',
            'PRODUCTTYP' => 'Producttyp',
            'CATEGORYID' => 'Categoryid',
            'subcategory' => 'Subcategory',
            'Brand' => 'Brand',
            'Model' => 'Model',
            'SPECIFICAT' => 'Specificat',
            'Info1' => 'Info1',
            'Info2' => 'Info2',
            'Info3' => 'Info3',
            'Info4' => 'Info4',
            'Info5' => 'Info5',
            'Info6' => 'Info6',
            'Info7' => 'Info7',
            'Info8' => 'Info8',
            'PMID' => 'Pmid',
            'EOL' => 'Eol',
            'NoPrint' => 'No Print',
            'PrintPrice' => 'Print Price',
            'Percent3' => 'Percent3',
            'Percent6' => 'Percent6',
            'Percent12' => 'Percent12',
            'LeadTime' => 'Lead Time',
            'DrAcc' => 'Dr Acc',
            'CrAcc' => 'Cr Acc',
            'Weight' => 'Weight',
            'ESTIMATEP' => 'Estimatep',
            'DutyP' => 'Duty P',
            'Status' => 'Status',
            'chk' => 'Chk',
            'productcode' => 'Productcode',
            'del' => 'Del',
            'effdate' => 'Effdate',
            'grade' => 'Grade',
            'lastpo' => 'Lastpo',
            'lastponum' => 'Lastponum',
            'newstatus' => 'Newstatus',
            'newstartdate' => 'Newstartdate',
            'lockproduct' => 'Lockproduct',
            'locknum' => 'Locknum',
            'autogen' => 'Autogen',
            'procomment' => 'Procomment',
            'reserve' => 'Reserve',
            'shortage' => 'Shortage',
            'upd' => 'Upd',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('Product', $this->Product, true);
        $criteria->compare('SUPPLIERCO', $this->SUPPLIERCO, true);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('Unit', $this->Unit, true);
        $criteria->compare('MDisType', $this->MDisType, true);
        $criteria->compare('MDisValue', $this->MDisValue, true);
        $criteria->compare('VAT', $this->VAT, true);
        $criteria->compare('PRODUCTTYP', $this->PRODUCTTYP, true);
        $criteria->compare('CATEGORYID', $this->CATEGORYID, true);
        $criteria->compare('subcategory', $this->subcategory, true);
        $criteria->compare('Brand', $this->Brand, true);
        $criteria->compare('Model', $this->Model, true);
        $criteria->compare('SPECIFICAT', $this->SPECIFICAT, true);
        $criteria->compare('Info1', $this->Info1, true);
        $criteria->compare('Info2', $this->Info2, true);
        $criteria->compare('Info3', $this->Info3, true);
        $criteria->compare('Info4', $this->Info4, true);
        $criteria->compare('Info5', $this->Info5, true);
        $criteria->compare('Info6', $this->Info6, true);
        $criteria->compare('Info7', $this->Info7, true);
        $criteria->compare('Info8', $this->Info8, true);
        $criteria->compare('PMID', $this->PMID, true);
        $criteria->compare('EOL', $this->EOL, true);
        $criteria->compare('NoPrint', $this->NoPrint, true);
        $criteria->compare('PrintPrice', $this->PrintPrice, true);
        $criteria->compare('Percent3', $this->Percent3, true);
        $criteria->compare('Percent6', $this->Percent6, true);
        $criteria->compare('Percent12', $this->Percent12, true);
        $criteria->compare('LeadTime', $this->LeadTime, true);
        $criteria->compare('DrAcc', $this->DrAcc, true);
        $criteria->compare('CrAcc', $this->CrAcc, true);
        $criteria->compare('Weight', $this->Weight, true);
        $criteria->compare('ESTIMATEP', $this->ESTIMATEP, true);
        $criteria->compare('DutyP', $this->DutyP, true);
        $criteria->compare('Status', $this->Status, true);
        $criteria->compare('chk', $this->chk, true);
        $criteria->compare('productcode', $this->productcode, true);
        $criteria->compare('del', $this->del, true);
        $criteria->compare('effdate', $this->effdate, true);
        $criteria->compare('grade', $this->grade, true);
        $criteria->compare('lastpo', $this->lastpo, true);
        $criteria->compare('lastponum', $this->lastponum);
        $criteria->compare('newstatus', $this->newstatus);
        $criteria->compare('newstartdate', $this->newstartdate, true);
        $criteria->compare('lockproduct', $this->lockproduct);
        $criteria->compare('locknum', $this->locknum);
        $criteria->compare('autogen', $this->autogen);
        $criteria->compare('procomment', $this->procomment, true);
        $criteria->compare('reserve', $this->reserve);
        $criteria->compare('shortage', $this->shortage, true);
        $criteria->compare('upd', $this->upd, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}