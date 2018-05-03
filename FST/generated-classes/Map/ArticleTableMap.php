<?php

namespace Map;

use \Article;
use \ArticleQuery;
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
 * This class defines the structure of the 'article' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ArticleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ArticleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'FST4';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'article';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Article';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Article';

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
     * the column name for the article_id field
     */
    const COL_ARTICLE_ID = 'article.article_id';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'article.description';

    /**
     * the column name for the price field
     */
    const COL_PRICE = 'article.price';

    /**
     * the column name for the creation field
     */
    const COL_CREATION = 'article.creation';

    /**
     * the column name for the visible field
     */
    const COL_VISIBLE = 'article.visible';

    /**
     * the column name for the shape_id field
     */
    const COL_SHAPE_ID = 'article.shape_id';

    /**
     * the column name for the cake_type_id field
     */
    const COL_CAKE_TYPE_ID = 'article.cake_type_id';

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
        self::TYPE_PHPNAME       => array('ArticleId', 'Description', 'Price', 'Creation', 'Visible', 'ShapeId', 'CakeTypeId', ),
        self::TYPE_CAMELNAME     => array('articleId', 'description', 'price', 'creation', 'visible', 'shapeId', 'cakeTypeId', ),
        self::TYPE_COLNAME       => array(ArticleTableMap::COL_ARTICLE_ID, ArticleTableMap::COL_DESCRIPTION, ArticleTableMap::COL_PRICE, ArticleTableMap::COL_CREATION, ArticleTableMap::COL_VISIBLE, ArticleTableMap::COL_SHAPE_ID, ArticleTableMap::COL_CAKE_TYPE_ID, ),
        self::TYPE_FIELDNAME     => array('article_id', 'description', 'price', 'creation', 'visible', 'shape_id', 'cake_type_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ArticleId' => 0, 'Description' => 1, 'Price' => 2, 'Creation' => 3, 'Visible' => 4, 'ShapeId' => 5, 'CakeTypeId' => 6, ),
        self::TYPE_CAMELNAME     => array('articleId' => 0, 'description' => 1, 'price' => 2, 'creation' => 3, 'visible' => 4, 'shapeId' => 5, 'cakeTypeId' => 6, ),
        self::TYPE_COLNAME       => array(ArticleTableMap::COL_ARTICLE_ID => 0, ArticleTableMap::COL_DESCRIPTION => 1, ArticleTableMap::COL_PRICE => 2, ArticleTableMap::COL_CREATION => 3, ArticleTableMap::COL_VISIBLE => 4, ArticleTableMap::COL_SHAPE_ID => 5, ArticleTableMap::COL_CAKE_TYPE_ID => 6, ),
        self::TYPE_FIELDNAME     => array('article_id' => 0, 'description' => 1, 'price' => 2, 'creation' => 3, 'visible' => 4, 'shape_id' => 5, 'cake_type_id' => 6, ),
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
        $this->setName('article');
        $this->setPhpName('Article');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Article');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('article_id', 'ArticleId', 'INTEGER', true, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 45, null);
        $this->addColumn('price', 'Price', 'DOUBLE', false, null, null);
        $this->addColumn('creation', 'Creation', 'VARCHAR', false, 1, null);
        $this->addColumn('visible', 'Visible', 'VARCHAR', false, 1, null);
        $this->addForeignKey('shape_id', 'ShapeId', 'INTEGER', 'shape', 'shape_id', true, null, null);
        $this->addForeignKey('cake_type_id', 'CakeTypeId', 'INTEGER', 'cake_type', 'cake_type_id', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CakeType', '\\CakeType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':cake_type_id',
    1 => ':cake_type_id',
  ),
), null, null, null, false);
        $this->addRelation('Shape', '\\Shape', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':shape_id',
    1 => ':shape_id',
  ),
), null, null, null, false);
        $this->addRelation('ArticleHasIngredient', '\\ArticleHasIngredient', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':article_id',
    1 => ':article_id',
  ),
), null, null, 'ArticleHasIngredients', false);
        $this->addRelation('OrderHasArticles', '\\OrderHasArticles', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':article_id',
    1 => ':article_id',
  ),
), null, null, 'OrderHasArticless', false);
        $this->addRelation('PackageHasArticles', '\\PackageHasArticles', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':article_id',
    1 => ':article_id',
  ),
), null, null, 'PackageHasArticless', false);
        $this->addRelation('Rating', '\\Rating', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':article_id',
    1 => ':article_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ArticleId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ArticleId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ArticleId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ArticleId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ArticleId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ArticleId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ArticleId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ArticleTableMap::CLASS_DEFAULT : ArticleTableMap::OM_CLASS;
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
     * @return array           (Article object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ArticleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ArticleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ArticleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ArticleTableMap::OM_CLASS;
            /** @var Article $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ArticleTableMap::addInstanceToPool($obj, $key);
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
            $key = ArticleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ArticleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Article $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ArticleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ArticleTableMap::COL_ARTICLE_ID);
            $criteria->addSelectColumn(ArticleTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ArticleTableMap::COL_PRICE);
            $criteria->addSelectColumn(ArticleTableMap::COL_CREATION);
            $criteria->addSelectColumn(ArticleTableMap::COL_VISIBLE);
            $criteria->addSelectColumn(ArticleTableMap::COL_SHAPE_ID);
            $criteria->addSelectColumn(ArticleTableMap::COL_CAKE_TYPE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.article_id');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.creation');
            $criteria->addSelectColumn($alias . '.visible');
            $criteria->addSelectColumn($alias . '.shape_id');
            $criteria->addSelectColumn($alias . '.cake_type_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(ArticleTableMap::DATABASE_NAME)->getTable(ArticleTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ArticleTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ArticleTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ArticleTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Article or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Article object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ArticleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Article) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ArticleTableMap::DATABASE_NAME);
            $criteria->add(ArticleTableMap::COL_ARTICLE_ID, (array) $values, Criteria::IN);
        }

        $query = ArticleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ArticleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ArticleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the article table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ArticleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Article or Criteria object.
     *
     * @param mixed               $criteria Criteria or Article object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArticleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Article object
        }


        // Set the correct dbName
        $query = ArticleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ArticleTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ArticleTableMap::buildTableMap();
