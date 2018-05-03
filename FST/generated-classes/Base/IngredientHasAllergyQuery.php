<?php

namespace Base;

use \IngredientHasAllergy as ChildIngredientHasAllergy;
use \IngredientHasAllergyQuery as ChildIngredientHasAllergyQuery;
use \Exception;
use \PDO;
use Map\IngredientHasAllergyTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ingredient_has_allergy' table.
 *
 *
 *
 * @method     ChildIngredientHasAllergyQuery orderByIngredientId($order = Criteria::ASC) Order by the ingredient_id column
 * @method     ChildIngredientHasAllergyQuery orderByAllergyId($order = Criteria::ASC) Order by the allergy_id column
 *
 * @method     ChildIngredientHasAllergyQuery groupByIngredientId() Group by the ingredient_id column
 * @method     ChildIngredientHasAllergyQuery groupByAllergyId() Group by the allergy_id column
 *
 * @method     ChildIngredientHasAllergyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildIngredientHasAllergyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildIngredientHasAllergyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildIngredientHasAllergyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildIngredientHasAllergyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildIngredientHasAllergyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildIngredientHasAllergyQuery leftJoinAllergy($relationAlias = null) Adds a LEFT JOIN clause to the query using the Allergy relation
 * @method     ChildIngredientHasAllergyQuery rightJoinAllergy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Allergy relation
 * @method     ChildIngredientHasAllergyQuery innerJoinAllergy($relationAlias = null) Adds a INNER JOIN clause to the query using the Allergy relation
 *
 * @method     ChildIngredientHasAllergyQuery joinWithAllergy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Allergy relation
 *
 * @method     ChildIngredientHasAllergyQuery leftJoinWithAllergy() Adds a LEFT JOIN clause and with to the query using the Allergy relation
 * @method     ChildIngredientHasAllergyQuery rightJoinWithAllergy() Adds a RIGHT JOIN clause and with to the query using the Allergy relation
 * @method     ChildIngredientHasAllergyQuery innerJoinWithAllergy() Adds a INNER JOIN clause and with to the query using the Allergy relation
 *
 * @method     ChildIngredientHasAllergyQuery leftJoinIngredient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ingredient relation
 * @method     ChildIngredientHasAllergyQuery rightJoinIngredient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ingredient relation
 * @method     ChildIngredientHasAllergyQuery innerJoinIngredient($relationAlias = null) Adds a INNER JOIN clause to the query using the Ingredient relation
 *
 * @method     ChildIngredientHasAllergyQuery joinWithIngredient($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ingredient relation
 *
 * @method     ChildIngredientHasAllergyQuery leftJoinWithIngredient() Adds a LEFT JOIN clause and with to the query using the Ingredient relation
 * @method     ChildIngredientHasAllergyQuery rightJoinWithIngredient() Adds a RIGHT JOIN clause and with to the query using the Ingredient relation
 * @method     ChildIngredientHasAllergyQuery innerJoinWithIngredient() Adds a INNER JOIN clause and with to the query using the Ingredient relation
 *
 * @method     \AllergyQuery|\IngredientQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildIngredientHasAllergy findOne(ConnectionInterface $con = null) Return the first ChildIngredientHasAllergy matching the query
 * @method     ChildIngredientHasAllergy findOneOrCreate(ConnectionInterface $con = null) Return the first ChildIngredientHasAllergy matching the query, or a new ChildIngredientHasAllergy object populated from the query conditions when no match is found
 *
 * @method     ChildIngredientHasAllergy findOneByIngredientId(int $ingredient_id) Return the first ChildIngredientHasAllergy filtered by the ingredient_id column
 * @method     ChildIngredientHasAllergy findOneByAllergyId(int $allergy_id) Return the first ChildIngredientHasAllergy filtered by the allergy_id column *

 * @method     ChildIngredientHasAllergy requirePk($key, ConnectionInterface $con = null) Return the ChildIngredientHasAllergy by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIngredientHasAllergy requireOne(ConnectionInterface $con = null) Return the first ChildIngredientHasAllergy matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIngredientHasAllergy requireOneByIngredientId(int $ingredient_id) Return the first ChildIngredientHasAllergy filtered by the ingredient_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIngredientHasAllergy requireOneByAllergyId(int $allergy_id) Return the first ChildIngredientHasAllergy filtered by the allergy_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIngredientHasAllergy[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildIngredientHasAllergy objects based on current ModelCriteria
 * @method     ChildIngredientHasAllergy[]|ObjectCollection findByIngredientId(int $ingredient_id) Return ChildIngredientHasAllergy objects filtered by the ingredient_id column
 * @method     ChildIngredientHasAllergy[]|ObjectCollection findByAllergyId(int $allergy_id) Return ChildIngredientHasAllergy objects filtered by the allergy_id column
 * @method     ChildIngredientHasAllergy[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class IngredientHasAllergyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\IngredientHasAllergyQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\IngredientHasAllergy', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildIngredientHasAllergyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildIngredientHasAllergyQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildIngredientHasAllergyQuery) {
            return $criteria;
        }
        $query = new ChildIngredientHasAllergyQuery();
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
     * @param array[$ingredient_id, $allergy_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildIngredientHasAllergy|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(IngredientHasAllergyTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = IngredientHasAllergyTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildIngredientHasAllergy A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ingredient_id, allergy_id FROM ingredient_has_allergy WHERE ingredient_id = :p0 AND allergy_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildIngredientHasAllergy $obj */
            $obj = new ChildIngredientHasAllergy();
            $obj->hydrate($row);
            IngredientHasAllergyTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildIngredientHasAllergy|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildIngredientHasAllergyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(IngredientHasAllergyTableMap::COL_INGREDIENT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(IngredientHasAllergyTableMap::COL_ALLERGY_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildIngredientHasAllergyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(IngredientHasAllergyTableMap::COL_INGREDIENT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(IngredientHasAllergyTableMap::COL_ALLERGY_ID, $key[1], Criteria::EQUAL);
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
     * $query->filterByIngredientId(1234); // WHERE ingredient_id = 1234
     * $query->filterByIngredientId(array(12, 34)); // WHERE ingredient_id IN (12, 34)
     * $query->filterByIngredientId(array('min' => 12)); // WHERE ingredient_id > 12
     * </code>
     *
     * @see       filterByIngredient()
     *
     * @param     mixed $ingredientId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIngredientHasAllergyQuery The current query, for fluid interface
     */
    public function filterByIngredientId($ingredientId = null, $comparison = null)
    {
        if (is_array($ingredientId)) {
            $useMinMax = false;
            if (isset($ingredientId['min'])) {
                $this->addUsingAlias(IngredientHasAllergyTableMap::COL_INGREDIENT_ID, $ingredientId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ingredientId['max'])) {
                $this->addUsingAlias(IngredientHasAllergyTableMap::COL_INGREDIENT_ID, $ingredientId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredientHasAllergyTableMap::COL_INGREDIENT_ID, $ingredientId, $comparison);
    }

    /**
     * Filter the query on the allergy_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAllergyId(1234); // WHERE allergy_id = 1234
     * $query->filterByAllergyId(array(12, 34)); // WHERE allergy_id IN (12, 34)
     * $query->filterByAllergyId(array('min' => 12)); // WHERE allergy_id > 12
     * </code>
     *
     * @see       filterByAllergy()
     *
     * @param     mixed $allergyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIngredientHasAllergyQuery The current query, for fluid interface
     */
    public function filterByAllergyId($allergyId = null, $comparison = null)
    {
        if (is_array($allergyId)) {
            $useMinMax = false;
            if (isset($allergyId['min'])) {
                $this->addUsingAlias(IngredientHasAllergyTableMap::COL_ALLERGY_ID, $allergyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($allergyId['max'])) {
                $this->addUsingAlias(IngredientHasAllergyTableMap::COL_ALLERGY_ID, $allergyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredientHasAllergyTableMap::COL_ALLERGY_ID, $allergyId, $comparison);
    }

    /**
     * Filter the query by a related \Allergy object
     *
     * @param \Allergy|ObjectCollection $allergy The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildIngredientHasAllergyQuery The current query, for fluid interface
     */
    public function filterByAllergy($allergy, $comparison = null)
    {
        if ($allergy instanceof \Allergy) {
            return $this
                ->addUsingAlias(IngredientHasAllergyTableMap::COL_ALLERGY_ID, $allergy->getAllergyId(), $comparison);
        } elseif ($allergy instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(IngredientHasAllergyTableMap::COL_ALLERGY_ID, $allergy->toKeyValue('PrimaryKey', 'AllergyId'), $comparison);
        } else {
            throw new PropelException('filterByAllergy() only accepts arguments of type \Allergy or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Allergy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildIngredientHasAllergyQuery The current query, for fluid interface
     */
    public function joinAllergy($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Allergy');

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
            $this->addJoinObject($join, 'Allergy');
        }

        return $this;
    }

    /**
     * Use the Allergy relation Allergy object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AllergyQuery A secondary query class using the current class as primary query
     */
    public function useAllergyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAllergy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Allergy', '\AllergyQuery');
    }

    /**
     * Filter the query by a related \Ingredient object
     *
     * @param \Ingredient|ObjectCollection $ingredient The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildIngredientHasAllergyQuery The current query, for fluid interface
     */
    public function filterByIngredient($ingredient, $comparison = null)
    {
        if ($ingredient instanceof \Ingredient) {
            return $this
                ->addUsingAlias(IngredientHasAllergyTableMap::COL_INGREDIENT_ID, $ingredient->getIngredientId(), $comparison);
        } elseif ($ingredient instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(IngredientHasAllergyTableMap::COL_INGREDIENT_ID, $ingredient->toKeyValue('PrimaryKey', 'IngredientId'), $comparison);
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
     * @return $this|ChildIngredientHasAllergyQuery The current query, for fluid interface
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
     * @param   ChildIngredientHasAllergy $ingredientHasAllergy Object to remove from the list of results
     *
     * @return $this|ChildIngredientHasAllergyQuery The current query, for fluid interface
     */
    public function prune($ingredientHasAllergy = null)
    {
        if ($ingredientHasAllergy) {
            $this->addCond('pruneCond0', $this->getAliasedColName(IngredientHasAllergyTableMap::COL_INGREDIENT_ID), $ingredientHasAllergy->getIngredientId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(IngredientHasAllergyTableMap::COL_ALLERGY_ID), $ingredientHasAllergy->getAllergyId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ingredient_has_allergy table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IngredientHasAllergyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            IngredientHasAllergyTableMap::clearInstancePool();
            IngredientHasAllergyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(IngredientHasAllergyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(IngredientHasAllergyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            IngredientHasAllergyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            IngredientHasAllergyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // IngredientHasAllergyQuery
