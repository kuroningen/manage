<?php namespace project\mvc\model;

/**
 * modelCommon
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\model
 * @since   2018.11.03
 */
abstract class modelCommon
{
    /**
     * Name of table
     *
     * @var string
     */
    protected $sTable;

    /**
     * Structure of Table
     *
     * @var array
     */
    protected $aStructure;

    /**
     * Name of Primary Key Field
     *
     * @var string
     */
    protected $sPrimaryKey = 'id';

    /**
     * Inserts data to storage
     *
     * @param  array $aParams Things to save (To be determined by the implementation
     * @return array           Returns the entire data, including it's identifier that can identify itself for read function
     */
    public function create($aParams)
    {
        $oModel = new $this->sTable;
        $aRow = $this->createRow($aParams);
        foreach ($aRow as $sKey => $mValue) {
            $oModel->{$sKey} = $mValue;
        }
        $oModel->save();
        return $oModel->toArray();
    }

    /**
     * Reads specific data based on a criteria from the storage
     *
     * @param  array $aWhere
     * @return array
     */
    public function read($aWhere)
    {
        $oCollection = $this->find($aWhere);
        return (count($oCollection) === 0) ? [] : $oCollection->toArray();
    }

    /**
     * Reads everything relevant on this implementation from the storage
     *
     * @return mixed
     */
    public function readAll()
    {
        return $this->sTable::all()->toArray();
    }

    /**
     * Updates the data from storage, based on the criteria specified
     *
     * @param  array $aWhere Parameter that contains the criteria of what to change
     * @param  array $aValues Parameter that contains the change
     * @return array           Returns all updated data, and their current value
     */
    public function update($aWhere, $aValues)
    {
        $aRow = $this->createRow($aValues);
        $oCollection = $this->find($aWhere);
        if (\count($oCollection) === 0) {
            return [];
        }
        foreach ($oCollection as $oRow) {
            foreach ($aRow as $sKey => $mValue) {
                $oRow->{$sKey} = $mValue;
            }
            $oRow->save();
        }
        return $oCollection->toArray();
    }

    /**
     * Deletes something from storage, based on the criteria given
     *
     * @param  array $aWhere Parameter that contains the criteria of what to delete
     * @return array
     */
    public function delete($aWhere)
    {
        $oCollection = $this->find($aWhere);
        if (count($oCollection) === 0) {
            return [];
        }

        $aDeleted = $oCollection->toArray();
        foreach ($oCollection as $oRow) {
            $oRow->delete();
        }

        return $aDeleted;
    }

    /**
     * Creates a valid row
     *
     * @param $aParams
     * @return array
     */
    private function createRow($aParams)
    {
        return array_intersect_key($aParams, $this->aStructure);
    }

    /**
     * Finds data from table
     *
     * @param $aWhere
     * @return mixed
     */
    private function find($aWhere)
    {
        $oModel = new $this->sTable;
        return $oModel->newQuery()->where($aWhere)->get();
    }

    /**
     * Finds data from table
     *
     * @return mixed
     */
    public function findRecord()
    {
        $oModel = new $this->sTable;
        return $oModel;
    }
}
