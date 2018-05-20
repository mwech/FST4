<?php

namespace Base;

use \Ingredient as ChildIngredient;
use \IngredientQuery as ChildIngredientQuery;
use \Exception;
use \PDO;
use Map\IngredientTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ingredient' table.
 *
 *
 *
 * @method     ChildIngredientQuery orderByIngredientId($order = Criteria::ASC) Order by the ingredient_id column
 * @method     ChildIngredientQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildIngredientQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildIngredientQuery orderByIngAvailable($order = Criteria::ASC) Order by the ing_available column
 *
 * @method     ChildIngredientQuery groupByIngredientId() Group by the ingredient_id column
 * @method     ChildIngredientQuery groupByDescription() Group by the description column
 * @method     ChildIngredientQuery groupByPrice() Group by the price column
 * @method     ChildIngredientQuery groupByIngAvailable() Group by the ing_available column
 *
 * @method     ChildIngredientQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildIngredientQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildIngredientQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildIngredientQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildIngredientQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildIngredientQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildIngredientQuery leftJoinArticleHasIngredient($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArticleHasIngredient relation
 * @method     ChildIngredientQuery rightJoinArticleHasIngredient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArticleHasIngredient relation
 * @method     ChildIngredientQuery innerJoinArticleHasIngredient($relationAlias = null) Adds a INNER JOIN clause to the query using the ArticleHasIngredient relation
 *
 * @method     ChildIngredientQuery joinWithArticleHasIngredient($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ArticleHasIngredient relation
 *
 * @method     ChildIngredientQuery leftJoinWithArticleHasIngredient() Adds a LEFT JOIN clause and with to the query using the ArticleHasIngredient relation
 * @method     ChildIngredientQuery rightJoinWithArticleHasIngredient() Adds a RIGHT JOIN clause and with to the query using the ArticleHasIngredient relation
 * @method     ChildIngredientQuery innerJoinWithArticleHasIngredient() Adds a INNER JOIN clause and with to the query using the ArticleHasIngredient relation
 *
 * @method     ChildIngredientQuery leftJoinIngredientHasCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the IngredientHasCategory relation
 * @method     ChildIngredientQuery rightJoinIngredientHasCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the IngredientHasCategory relation
 * @method     ChildIngredientQuery innerJoinIngredientHasCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the IngredientHasCategory relation
 *
 * @method     ChildIngredientQuery joinWithIngredientHasCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the IngredientHasCategory relation
 *
 * @method     ChildIngredientQuery leftJoinWithIngredientHasCategory() Adds a LEFT JOIN clause and with to the query using the IngredientHasCategory relation
 * @method     ChildIngredientQuery rightJoinWithIngredientHasCategory() Adds a RIGHT JOIN clause and with to the query using the IngredientHasCategory relation
 * @method     ChildIngredientQuery innerJoinWithIngredientHasCategory() Adds a INNER JOIN clause and with to the query using the IngredientHasCategory relation
 *
 * @method     \ArticleHasIngredientQuery|\IngredientHasCategoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildIngredient findOne(ConnectionInterface $con = null) Return the first ChildIngredient matching the query
 * @method     ChildIngredient findOneOrCreate(ConnectionInterface $con = null) Return the first ChildIngredient matching the query, or a new ChildIngredient object populated from the query conditions when no match is found
 *
 * @method     ChildIngredient findOneByIngredientId(string $ingredient_id) Return the first ChildIngredient filtered by the ingredient_id column
 * @method     ChildIngredient findOneByDescription(string $description) Return the first ChildIngredient filtered by the description column
 * @method     ChildIngredient findOneByPrice(double $price) Return the first ChildIngredient filtered by the price column
 * @method     ChildIngredient findOneByIngAvailable(string $ing_available) Return the first ChildIngredient filtered by the ing_available column *

 * @method     ChildIngredient requirePk($key, ConnectionInterface $con = null) Return the ChildIngredient by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIngredient requireOne(ConnectionInterface $con = null) Return the first ChildIngredient matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIngredient requireOneByIngredientId(string $ingredient_id) Return the first ChildIngredient filtered by the ingredient_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIngredient requireOneByDescription(string $description) Return the first ChildIngredient filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIngredient requireOneByPrice(double $price) Return the first ChildIngredient filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIngredient requireOneByIngAvailable(string $ing_available) Return the first ChildIngredient filtered by the ing_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIngredient[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildIngredient objects based on current ModelCriteria
 * @method     ChildIngredient[]|ObjectCollection findByIngredientId(string $ingredient_id) Return ChildIngredient objects filtered by the ingredient_id column
 * @method     ChildIngredient[]|ObjectCollection findByDescription(string $description) Return ChildIngredient objects filtered by the description column
 * @method     ChildIngredient[]|ObjectCollection findByPrice(double $price) Return ChildIngredient objects filtered by the price column
 * @method     ChildIngredient[]|ObjectCollection findByIngAvailable(string $ing_available) Return ChildIngredient objects filtered by the ing_available column
 * @method     ChildIngredient[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class IngredientQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\IngredientQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\Ingredient', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildIngredientQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildIngredientQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildIngredientQuery) {
            return $criteria;
        }
        $query = new ChildIngredientQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildIngredient|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(IngredientTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = IngredientTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildIngredient A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ingredient_id, description, price, ing_available FROM ingredient WHERE ingredient_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildIngredient $obj */
            $obj = new ChildIngredient();
            $obj->hydrate($row);
            IngredientTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildIngredient|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildIngredientQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(IngredientTableMap::COL_INGREDIENT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildIngredientQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(IngredientTableMap::COL_INGREDIENT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ingredient_id column
     *
     * Example usage:
     * <code>
     * $query->filterByIngredientId('fooValue');   // WHERE ingredient_id = 'fooValue'
     * $query->filterByIngredientId('%fooValue%', Criteria::LIKE); // WHERE ingredient_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ingredientId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIngredientQuery The current query, for fluid interface
     */
    public function filterByIngredientId($ingredientId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ingredientId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredientTableMap::COL_INGREDIENT_ID, $ingredientId, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIngredientQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredientTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIngredientQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(IngredientTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(IngredientTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredientTableMap::COL_PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the ing_available column
     *
     * Example usage:
     * <code>
     * $query->filterByIngAvailable('fooValue');   // WHERE ing_available = 'fooValue'
     * $query->filterByIngAvailable('%fooValue%', Criteria::LIKE); // WHERE ing_available LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ingAvailable The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIngredientQuery The current query, for fluid interface
     */
    public function filterByIngAvailable($ingAvailable = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ingAvailable)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredientTableMap::COL_ING_AVAILABLE, $ingAvailable, $comparison);
    }

    /**
     * Filter the query by a related \ArticleHasIngredient object
     *
     * @param \ArticleHasIngredient|ObjectCollection $articleHasIngredient the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildIngredientQuery The current query, for fluid interface
     */
    public function filterByArticleHasIngredient($articleHasIngredient, $comparison = null)
    {
        if ($articleHasIngredient instanceof \ArticleHasIngredient) {
            return $this
                ->addUsingAlias(IngredientTableMap::COL_INGREDIENT_ID, $articleHasIngredient->getIngredientId(), $comparison);
        } elseif ($articleHasIngredient instanceof ObjectCollection) {
            return $this
                ->useArticleHasIngredientQuery()
                ->filterByPrimaryKeys($articleHasIngredient->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByArticleHasIngredient() only accepts arguments of type \ArticleHasIngredient or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ArticleHasIngredient relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildIngredientQuery The current query, for fluid interface
     */
    public function joinArticleHasIngredient($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ArticleHasIngredient');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ArticleHasIngredient');
        }

        return $this;
    }

    /**
     * Use the ArticleHasIngredient relation ArticleHasIngredient object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ArticleHasIngredientQuery A secondary query class using the current class as primary query
     */
    public function useArticleHasIngredientQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinArticleHasIngredient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ArticleHasIngredient', '\ArticleHasIngredientQuery');
    }

    /**
     * Filter the query by a related \IngredientHasCategory object
     *
     * @param \IngredientHasCategory|ObjectCollection $ingredientHasCategory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildIngredientQuery The current query, for fluid interface
     */
    public function filterByIngredientHasCategory($ingredientHasCategory, $comparison = null)
    {
        if ($ingredientHasCategory instanceof \IngredientHasCategory) {
            return $this
                ->addUsingAlias(IngredientTableMap::COL_INGREDIENT_ID, $ingredientHasCategory->getIngredientId(), $comparison);
        } elseif ($ingredientHasCategory instanceof ObjectCollection) {
            return $this
                ->useIngredientHasCategoryQuery()
                ->filterByPrimaryKeys($ingredientHasCategory->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByIngredientHasCategory() only accepts arguments of type \IngredientHasCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the IngredientHasCategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildIngredientQuery The current query, for fluid interface
     */
    public function joinIngredientHasCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('IngredientHasCategory');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'IngredientHasCategory');
        }

        return $this;
    }

    /**
     * Use the IngredientHasCategory relation IngredientHasCategory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \IngredientHasCategoryQuery A secondary query class using the current class as primary query
     */
    public function useIngredientHasCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinIngredientHasCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'IngredientHasCategory', '\IngredientHasCategoryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildIngredient $ingredient Object to remove from the list of results
     *
     * @return $this|ChildIngredientQuery The current query, for fluid interface
     */
    public function prune($ingredient = null)
    {
        if ($ingredient) {
            $this->addUsingAlias(IngredientTableMap::COL_INGREDIENT_ID, $ingredient->getIngredientId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ingredient table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IngredientTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            IngredientTableMap::clearInstancePool();
            IngredientTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IngredientTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(IngredientTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            IngredientTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            IngredientTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // IngredientQuery
