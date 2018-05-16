<?php

namespace Base;

use \IngredientHasCategory as ChildIngredientHasCategory;
use \IngredientHasCategoryQuery as ChildIngredientHasCategoryQuery;
use \Exception;
use \PDO;
use Map\IngredientHasCategoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ingredient_has_category' table.
 *
 *
 *
 * @method     ChildIngredientHasCategoryQuery orderByIngredientId($order = Criteria::ASC) Order by the ingredient_id column
 * @method     ChildIngredientHasCategoryQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 *
 * @method     ChildIngredientHasCategoryQuery groupByIngredientId() Group by the ingredient_id column
 * @method     ChildIngredientHasCategoryQuery groupByCategoryId() Group by the category_id column
 *
 * @method     ChildIngredientHasCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildIngredientHasCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildIngredientHasCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildIngredientHasCategoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildIngredientHasCategoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildIngredientHasCategoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildIngredientHasCategoryQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ChildIngredientHasCategoryQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ChildIngredientHasCategoryQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ChildIngredientHasCategoryQuery joinWithCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Category relation
 *
 * @method     ChildIngredientHasCategoryQuery leftJoinWithCategory() Adds a LEFT JOIN clause and with to the query using the Category relation
 * @method     ChildIngredientHasCategoryQuery rightJoinWithCategory() Adds a RIGHT JOIN clause and with to the query using the Category relation
 * @method     ChildIngredientHasCategoryQuery innerJoinWithCategory() Adds a INNER JOIN clause and with to the query using the Category relation
 *
 * @method     ChildIngredientHasCategoryQuery leftJoinIngredient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ingredient relation
 * @method     ChildIngredientHasCategoryQuery rightJoinIngredient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ingredient relation
 * @method     ChildIngredientHasCategoryQuery innerJoinIngredient($relationAlias = null) Adds a INNER JOIN clause to the query using the Ingredient relation
 *
 * @method     ChildIngredientHasCategoryQuery joinWithIngredient($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ingredient relation
 *
 * @method     ChildIngredientHasCategoryQuery leftJoinWithIngredient() Adds a LEFT JOIN clause and with to the query using the Ingredient relation
 * @method     ChildIngredientHasCategoryQuery rightJoinWithIngredient() Adds a RIGHT JOIN clause and with to the query using the Ingredient relation
 * @method     ChildIngredientHasCategoryQuery innerJoinWithIngredient() Adds a INNER JOIN clause and with to the query using the Ingredient relation
 *
 * @method     \CategoryQuery|\IngredientQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildIngredientHasCategory findOne(ConnectionInterface $con = null) Return the first ChildIngredientHasCategory matching the query
 * @method     ChildIngredientHasCategory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildIngredientHasCategory matching the query, or a new ChildIngredientHasCategory object populated from the query conditions when no match is found
 *
 * @method     ChildIngredientHasCategory findOneByIngredientId(string $ingredient_id) Return the first ChildIngredientHasCategory filtered by the ingredient_id column
 * @method     ChildIngredientHasCategory findOneByCategoryId(string $category_id) Return the first ChildIngredientHasCategory filtered by the category_id column *

 * @method     ChildIngredientHasCategory requirePk($key, ConnectionInterface $con = null) Return the ChildIngredientHasCategory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIngredientHasCategory requireOne(ConnectionInterface $con = null) Return the first ChildIngredientHasCategory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIngredientHasCategory requireOneByIngredientId(string $ingredient_id) Return the first ChildIngredientHasCategory filtered by the ingredient_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIngredientHasCategory requireOneByCategoryId(string $category_id) Return the first ChildIngredientHasCategory filtered by the category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIngredientHasCategory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildIngredientHasCategory objects based on current ModelCriteria
 * @method     ChildIngredientHasCategory[]|ObjectCollection findByIngredientId(string $ingredient_id) Return ChildIngredientHasCategory objects filtered by the ingredient_id column
 * @method     ChildIngredientHasCategory[]|ObjectCollection findByCategoryId(string $category_id) Return ChildIngredientHasCategory objects filtered by the category_id column
 * @method     ChildIngredientHasCategory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class IngredientHasCategoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\IngredientHasCategoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\IngredientHasCategory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildIngredientHasCategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildIngredientHasCategoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildIngredientHasCategoryQuery) {
            return $criteria;
        }
        $query = new ChildIngredientHasCategoryQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$ingredient_id, $category_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildIngredientHasCategory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(IngredientHasCategoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = IngredientHasCategoryTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildIngredientHasCategory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ingredient_id, category_id FROM ingredient_has_category WHERE ingredient_id = :p0 AND category_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildIngredientHasCategory $obj */
            $obj = new ChildIngredientHasCategory();
            $obj->hydrate($row);
            IngredientHasCategoryTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildIngredientHasCategory|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildIngredientHasCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(IngredientHasCategoryTableMap::COL_INGREDIENT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(IngredientHasCategoryTableMap::COL_CATEGORY_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildIngredientHasCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(IngredientHasCategoryTableMap::COL_INGREDIENT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(IngredientHasCategoryTableMap::COL_CATEGORY_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildIngredientHasCategoryQuery The current query, for fluid interface
     */
    public function filterByIngredientId($ingredientId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ingredientId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredientHasCategoryTableMap::COL_INGREDIENT_ID, $ingredientId, $comparison);
    }

    /**
     * Filter the query on the category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryId('fooValue');   // WHERE category_id = 'fooValue'
     * $query->filterByCategoryId('%fooValue%', Criteria::LIKE); // WHERE category_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $categoryId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIngredientHasCategoryQuery The current query, for fluid interface
     */
    public function filterByCategoryId($categoryId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categoryId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredientHasCategoryTableMap::COL_CATEGORY_ID, $categoryId, $comparison);
    }

    /**
     * Filter the query by a related \Category object
     *
     * @param \Category|ObjectCollection $category The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildIngredientHasCategoryQuery The current query, for fluid interface
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof \Category) {
            return $this
                ->addUsingAlias(IngredientHasCategoryTableMap::COL_CATEGORY_ID, $category->getCategoryId(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(IngredientHasCategoryTableMap::COL_CATEGORY_ID, $category->toKeyValue('PrimaryKey', 'CategoryId'), $comparison);
        } else {
            throw new PropelException('filterByCategory() only accepts arguments of type \Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Category relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildIngredientHasCategoryQuery The current query, for fluid interface
     */
    public function joinCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Category');

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
            $this->addJoinObject($join, 'Category');
        }

        return $this;
    }

    /**
     * Use the Category relation Category object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Category', '\CategoryQuery');
    }

    /**
     * Filter the query by a related \Ingredient object
     *
     * @param \Ingredient|ObjectCollection $ingredient The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildIngredientHasCategoryQuery The current query, for fluid interface
     */
    public function filterByIngredient($ingredient, $comparison = null)
    {
        if ($ingredient instanceof \Ingredient) {
            return $this
                ->addUsingAlias(IngredientHasCategoryTableMap::COL_INGREDIENT_ID, $ingredient->getIngredientId(), $comparison);
        } elseif ($ingredient instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(IngredientHasCategoryTableMap::COL_INGREDIENT_ID, $ingredient->toKeyValue('PrimaryKey', 'IngredientId'), $comparison);
        } else {
            throw new PropelException('filterByIngredient() only accepts arguments of type \Ingredient or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ingredient relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildIngredientHasCategoryQuery The current query, for fluid interface
     */
    public function joinIngredient($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ingredient');

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
            $this->addJoinObject($join, 'Ingredient');
        }

        return $this;
    }

    /**
     * Use the Ingredient relation Ingredient object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \IngredientQuery A secondary query class using the current class as primary query
     */
    public function useIngredientQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinIngredient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ingredient', '\IngredientQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildIngredientHasCategory $ingredientHasCategory Object to remove from the list of results
     *
     * @return $this|ChildIngredientHasCategoryQuery The current query, for fluid interface
     */
    public function prune($ingredientHasCategory = null)
    {
        if ($ingredientHasCategory) {
            $this->addCond('pruneCond0', $this->getAliasedColName(IngredientHasCategoryTableMap::COL_INGREDIENT_ID), $ingredientHasCategory->getIngredientId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(IngredientHasCategoryTableMap::COL_CATEGORY_ID), $ingredientHasCategory->getCategoryId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ingredient_has_category table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IngredientHasCategoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            IngredientHasCategoryTableMap::clearInstancePool();
            IngredientHasCategoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(IngredientHasCategoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(IngredientHasCategoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            IngredientHasCategoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            IngredientHasCategoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // IngredientHasCategoryQuery
