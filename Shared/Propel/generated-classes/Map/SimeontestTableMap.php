<?php

namespace Map;

use \Simeontest;
use \SimeontestQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'simeontest' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SimeontestTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SimeontestTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'FST4';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'simeontest';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Simeontest';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Simeontest';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    const COL_ID = 'simeontest.id';

    /**
     * the column name for the startdate field
     */
    const COL_STARTDATE = 'simeontest.startdate';

    /**
     * the column name for the amount field
     */
    const COL_AMOUNT = 'simeontest.amount';

    /**
     * the column name for the price field
     */
    const COL_PRICE = 'simeontest.price';

    /**
     * the column name for the used field
     */
    const COL_USED = 'simeontest.used';

    /**
     * the column name for the visible field
     */
    const COL_VISIBLE = 'simeontest.visible';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'simeontest.description';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Startdate', 'Amount', 'Price', 'Used', 'Visible', 'Description', ),
        self::TYPE_CAMELNAME     => array('id', 'startdate', 'amount', 'price', 'used', 'visible', 'description', ),
        self::TYPE_COLNAME       => array(SimeontestTableMap::COL_ID, SimeontestTableMap::COL_STARTDATE, SimeontestTableMap::COL_AMOUNT, SimeontestTableMap::COL_PRICE, SimeontestTableMap::COL_USED, SimeontestTableMap::COL_VISIBLE, SimeontestTableMap::COL_DESCRIPTION, ),
        self::TYPE_FIELDNAME     => array('id', 'startdate', 'amount', 'price', 'used', 'visible', 'description', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Startdate' => 1, 'Amount' => 2, 'Price' => 3, 'Used' => 4, 'Visible' => 5, 'Description' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'startdate' => 1, 'amount' => 2, 'price' => 3, 'used' => 4, 'visible' => 5, 'description' => 6, ),
        self::TYPE_COLNAME       => array(SimeontestTableMap::COL_ID => 0, SimeontestTableMap::COL_STARTDATE => 1, SimeontestTableMap::COL_AMOUNT => 2, SimeontestTableMap::COL_PRICE => 3, SimeontestTableMap::COL_USED => 4, SimeontestTableMap::COL_VISIBLE => 5, SimeontestTableMap::COL_DESCRIPTION => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'startdate' => 1, 'amount' => 2, 'price' => 3, 'used' => 4, 'visible' => 5, 'description' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('simeontest');
        $this->setPhpName('Simeontest');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Simeontest');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('id', 'Id', 'VARCHAR', true, 36, null);
        $this->addColumn('startdate', 'Startdate', 'DATE', true, null, null);
        $this->addColumn('amount', 'Amount', 'INTEGER', true, null, null);
        $this->addColumn('price', 'Price', 'DOUBLE', true, null, null);
        $this->addColumn('used', 'Used', 'VARCHAR', true, 1, null);
        $this->addColumn('visible', 'Visible', 'VARCHAR', true, 1, null);
        $this->addColumn('description', 'Description', 'VARCHAR', true, 50, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? SimeontestTableMap::CLASS_DEFAULT : SimeontestTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Simeontest object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SimeontestTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SimeontestTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SimeontestTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SimeontestTableMap::OM_CLASS;
            /** @var Simeontest $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SimeontestTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SimeontestTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SimeontestTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Simeontest $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SimeontestTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SimeontestTableMap::COL_ID);
            $criteria->addSelectColumn(SimeontestTableMap::COL_STARTDATE);
            $criteria->addSelectColumn(SimeontestTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(SimeontestTableMap::COL_PRICE);
            $criteria->addSelectColumn(SimeontestTableMap::COL_USED);
            $criteria->addSelectColumn(SimeontestTableMap::COL_VISIBLE);
            $criteria->addSelectColumn(SimeontestTableMap::COL_DESCRIPTION);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.startdate');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.used');
            $criteria->addSelectColumn($alias . '.visible');
            $criteria->addSelectColumn($alias . '.description');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(SimeontestTableMap::DATABASE_NAME)->getTable(SimeontestTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SimeontestTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SimeontestTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SimeontestTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Simeontest or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Simeontest object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SimeontestTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Simeontest) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SimeontestTableMap::DATABASE_NAME);
            $criteria->add(SimeontestTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SimeontestQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SimeontestTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SimeontestTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the simeontest table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SimeontestQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Simeontest or Criteria object.
     *
     * @param mixed               $criteria Criteria or Simeontest object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SimeontestTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Simeontest object
        }


        // Set the correct dbName
        $query = SimeontestQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SimeontestTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SimeontestTableMap::buildTableMap();
