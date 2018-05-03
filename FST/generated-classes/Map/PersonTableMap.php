<?php

namespace Map;

use \Person;
use \PersonQuery;
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
 * This class defines the structure of the 'person' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PersonTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PersonTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'FST4';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'person';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Person';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Person';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the person_id field
     */
    const COL_PERSON_ID = 'person.person_id';

    /**
     * the column name for the firstname field
     */
    const COL_FIRSTNAME = 'person.firstname';

    /**
     * the column name for the lastname field
     */
    const COL_LASTNAME = 'person.lastname';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'person.email';

    /**
     * the column name for the password field
     */
    const COL_PASSWORD = 'person.password';

    /**
     * the column name for the birthdate field
     */
    const COL_BIRTHDATE = 'person.birthdate';

    /**
     * the column name for the street field
     */
    const COL_STREET = 'person.street';

    /**
     * the column name for the country field
     */
    const COL_COUNTRY = 'person.country';

    /**
     * the column name for the zip_code field
     */
    const COL_ZIP_CODE = 'person.zip_code';

    /**
     * the column name for the type_id field
     */
    const COL_TYPE_ID = 'person.type_id';

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
        self::TYPE_PHPNAME       => array('PersonId', 'Firstname', 'Lastname', 'Email', 'Password', 'Birthdate', 'Street', 'Country', 'ZipCode', 'TypeId', ),
        self::TYPE_CAMELNAME     => array('personId', 'firstname', 'lastname', 'email', 'password', 'birthdate', 'street', 'country', 'zipCode', 'typeId', ),
        self::TYPE_COLNAME       => array(PersonTableMap::COL_PERSON_ID, PersonTableMap::COL_FIRSTNAME, PersonTableMap::COL_LASTNAME, PersonTableMap::COL_EMAIL, PersonTableMap::COL_PASSWORD, PersonTableMap::COL_BIRTHDATE, PersonTableMap::COL_STREET, PersonTableMap::COL_COUNTRY, PersonTableMap::COL_ZIP_CODE, PersonTableMap::COL_TYPE_ID, ),
        self::TYPE_FIELDNAME     => array('person_id', 'firstname', 'lastname', 'email', 'password', 'birthdate', 'street', 'country', 'zip_code', 'type_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('PersonId' => 0, 'Firstname' => 1, 'Lastname' => 2, 'Email' => 3, 'Password' => 4, 'Birthdate' => 5, 'Street' => 6, 'Country' => 7, 'ZipCode' => 8, 'TypeId' => 9, ),
        self::TYPE_CAMELNAME     => array('personId' => 0, 'firstname' => 1, 'lastname' => 2, 'email' => 3, 'password' => 4, 'birthdate' => 5, 'street' => 6, 'country' => 7, 'zipCode' => 8, 'typeId' => 9, ),
        self::TYPE_COLNAME       => array(PersonTableMap::COL_PERSON_ID => 0, PersonTableMap::COL_FIRSTNAME => 1, PersonTableMap::COL_LASTNAME => 2, PersonTableMap::COL_EMAIL => 3, PersonTableMap::COL_PASSWORD => 4, PersonTableMap::COL_BIRTHDATE => 5, PersonTableMap::COL_STREET => 6, PersonTableMap::COL_COUNTRY => 7, PersonTableMap::COL_ZIP_CODE => 8, PersonTableMap::COL_TYPE_ID => 9, ),
        self::TYPE_FIELDNAME     => array('person_id' => 0, 'firstname' => 1, 'lastname' => 2, 'email' => 3, 'password' => 4, 'birthdate' => 5, 'street' => 6, 'country' => 7, 'zip_code' => 8, 'type_id' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('person');
        $this->setPhpName('Person');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Person');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('person_id', 'PersonId', 'INTEGER', true, null, null);
        $this->addColumn('firstname', 'Firstname', 'VARCHAR', false, 45, null);
        $this->addColumn('lastname', 'Lastname', 'VARCHAR', false, 45, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 45, null);
        $this->addColumn('password', 'Password', 'VARCHAR', false, 45, null);
        $this->addColumn('birthdate', 'Birthdate', 'VARCHAR', false, 45, null);
        $this->addColumn('street', 'Street', 'VARCHAR', false, 45, null);
        $this->addColumn('country', 'Country', 'VARCHAR', false, 45, null);
        $this->addForeignKey('zip_code', 'ZipCode', 'INTEGER', 'city', 'zip_code', true, null, null);
        $this->addForeignKey('type_id', 'TypeId', 'INTEGER', 'type', 'type_id', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('City', '\\City', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':zip_code',
    1 => ':zip_code',
  ),
), null, null, null, false);
        $this->addRelation('Type', '\\Type', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':type_id',
    1 => ':type_id',
  ),
), null, null, null, false);
        $this->addRelation('BusinessCustomer', '\\BusinessCustomer', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':person_id',
    1 => ':person_id',
  ),
), null, null, 'BusinessCustomers', false);
        $this->addRelation('Order', '\\Order', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':person_id',
    1 => ':person_id',
  ),
), null, null, 'Orders', false);
        $this->addRelation('Rating', '\\Rating', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':person_id',
    1 => ':person_id',
  ),
), null, null, 'Ratings', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PersonTableMap::CLASS_DEFAULT : PersonTableMap::OM_CLASS;
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
     * @return array           (Person object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PersonTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PersonTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PersonTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PersonTableMap::OM_CLASS;
            /** @var Person $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PersonTableMap::addInstanceToPool($obj, $key);
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
            $key = PersonTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PersonTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Person $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PersonTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PersonTableMap::COL_PERSON_ID);
            $criteria->addSelectColumn(PersonTableMap::COL_FIRSTNAME);
            $criteria->addSelectColumn(PersonTableMap::COL_LASTNAME);
            $criteria->addSelectColumn(PersonTableMap::COL_EMAIL);
            $criteria->addSelectColumn(PersonTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(PersonTableMap::COL_BIRTHDATE);
            $criteria->addSelectColumn(PersonTableMap::COL_STREET);
            $criteria->addSelectColumn(PersonTableMap::COL_COUNTRY);
            $criteria->addSelectColumn(PersonTableMap::COL_ZIP_CODE);
            $criteria->addSelectColumn(PersonTableMap::COL_TYPE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.person_id');
            $criteria->addSelectColumn($alias . '.firstname');
            $criteria->addSelectColumn($alias . '.lastname');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.birthdate');
            $criteria->addSelectColumn($alias . '.street');
            $criteria->addSelectColumn($alias . '.country');
            $criteria->addSelectColumn($alias . '.zip_code');
            $criteria->addSelectColumn($alias . '.type_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(PersonTableMap::DATABASE_NAME)->getTable(PersonTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PersonTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PersonTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PersonTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Person or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Person object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PersonTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Person) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PersonTableMap::DATABASE_NAME);
            $criteria->add(PersonTableMap::COL_PERSON_ID, (array) $values, Criteria::IN);
        }

        $query = PersonQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PersonTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PersonTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the person table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PersonQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Person or Criteria object.
     *
     * @param mixed               $criteria Criteria or Person object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Person object
        }

        if ($criteria->containsKey(PersonTableMap::COL_PERSON_ID) && $criteria->keyContainsValue(PersonTableMap::COL_PERSON_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PersonTableMap::COL_PERSON_ID.')');
        }


        // Set the correct dbName
        $query = PersonQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PersonTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PersonTableMap::buildTableMap();
