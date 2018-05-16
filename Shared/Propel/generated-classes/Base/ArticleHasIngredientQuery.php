<?php

namespace Base;

use \ArticleHasIngredient as ChildArticleHasIngredient;
use \ArticleHasIngredientQuery as ChildArticleHasIngredientQuery;
use \Exception;
use \PDO;
use Map\ArticleHasIngredientTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'article_has_ingredient' table.
 *
 *
 *
 * @method     ChildArticleHasIngredientQuery orderByArticleId($order = Criteria::ASC) Order by the article_id column
 * @method     ChildArticleHasIngredientQuery orderByIngredientId($order = Criteria::ASC) Order by the ingredient_id column
 * @method     ChildArticleHasIngredientQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 *
 * @method     ChildArticleHasIngredientQuery groupByArticleId() Group by the article_id column
 * @method     ChildArticleHasIngredientQuery groupByIngredientId() Group by the ingredient_id column
 * @method     ChildArticleHasIngredientQuery groupByAmount() Group by the amount column
 *
 * @method     ChildArticleHasIngredientQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildArticleHasIngredientQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildArticleHasIngredientQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildArticleHasIngredientQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildArticleHasIngredientQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildArticleHasIngredientQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildArticleHasIngredientQuery leftJoinArticle($relationAlias = null) Adds a LEFT JOIN clause to the query using the Article relation
 * @method     ChildArticleHasIngredientQuery rightJoinArticle($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Article relation
 * @method     ChildArticleHasIngredientQuery innerJoinArticle($relationAlias = null) Adds a INNER JOIN clause to the query using the Article relation
 *
 * @method     ChildArticleHasIngredientQuery joinWithArticle($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Article relation
 *
 * @method     ChildArticleHasIngredientQuery leftJoinWithArticle() Adds a LEFT JOIN clause and with to the query using the Article relation
 * @method     ChildArticleHasIngredientQuery rightJoinWithArticle() Adds a RIGHT JOIN clause and with to the query using the Article relation
 * @method     ChildArticleHasIngredientQuery innerJoinWithArticle() Adds a INNER JOIN clause and with to the query using the Article relation
 *
 * @method     ChildArticleHasIngredientQuery leftJoinIngredient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ingredient relation
 * @method     ChildArticleHasIngredientQuery rightJoinIngredient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ingredient relation
 * @method     ChildArticleHasIngredientQuery innerJoinIngredient($relationAlias = null) Adds a INNER JOIN clause to the query using the Ingredient relation
 *
 * @method     ChildArticleHasIngredientQuery joinWithIngredient($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ingredient relation
 *
 * @method     ChildArticleHasIngredientQuery leftJoinWithIngredient() Adds a LEFT JOIN clause and with to the query using the Ingredient relation
 * @method     ChildArticleHasIngredientQuery rightJoinWithIngredient() Adds a RIGHT JOIN clause and with to the query using the Ingredient relation
 * @method     ChildArticleHasIngredientQuery innerJoinWithIngredient() Adds a INNER JOIN clause and with to the query using the Ingredient relation
 *
 * @method     \ArticleQuery|\IngredientQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildArticleHasIngredient findOne(ConnectionInterface $con = null) Return the first ChildArticleHasIngredient matching the query
 * @method     ChildArticleHasIngredient findOneOrCreate(ConnectionInterface $con = null) Return the first ChildArticleHasIngredient matching the query, or a new ChildArticleHasIngredient object populated from the query conditions when no match is found
 *
 * @method     ChildArticleHasIngredient findOneByArticleId(string $article_id) Return the first ChildArticleHasIngredient filtered by the article_id column
 * @method     ChildArticleHasIngredient findOneByIngredientId(string $ingredient_id) Return the first ChildArticleHasIngredient filtered by the ingredient_id column
 * @method     ChildArticleHasIngredient findOneByAmount(double $amount) Return the first ChildArticleHasIngredient filtered by the amount column *

 * @method     ChildArticleHasIngredient requirePk($key, ConnectionInterface $con = null) Return the ChildArticleHasIngredient by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticleHasIngredient requireOne(ConnectionInterface $con = null) Return the first ChildArticleHasIngredient matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildArticleHasIngredient requireOneByArticleId(string $article_id) Return the first ChildArticleHasIngredient filtered by the article_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticleHasIngredient requireOneByIngredientId(string $ingredient_id) Return the first ChildArticleHasIngredient filtered by the ingredient_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticleHasIngredient requireOneByAmount(double $amount) Return the first ChildArticleHasIngredient filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildArticleHasIngredient[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildArticleHasIngredient objects based on current ModelCriteria
 * @method     ChildArticleHasIngredient[]|ObjectCollection findByArticleId(string $article_id) Return ChildArticleHasIngredient objects filtered by the article_id column
 * @method     ChildArticleHasIngredient[]|ObjectCollection findByIngredientId(string $ingredient_id) Return ChildArticleHasIngredient objects filtered by the ingredient_id column
 * @method     ChildArticleHasIngredient[]|ObjectCollection findByAmount(double $amount) Return ChildArticleHasIngredient objects filtered by the amount column
 * @method     ChildArticleHasIngredient[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ArticleHasIngredientQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ArticleHasIngredientQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\ArticleHasIngredient', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildArticleHasIngredientQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildArticleHasIngredientQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildArticleHasIngredientQuery) {
            return $criteria;
        }
        $query = new ChildArticleHasIngredientQuery();
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
     * @param array[$article_id, $ingredient_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildArticleHasIngredient|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ArticleHasIngredientTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ArticleHasIngredientTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildArticleHasIngredient A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT article_id, ingredient_id, amount FROM article_has_ingredient WHERE article_id = :p0 AND ingredient_id = :p1';
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
            /** @var ChildArticleHasIngredient $obj */
            $obj = new ChildArticleHasIngredient();
            $obj->hydrate($row);
            ArticleHasIngredientTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildArticleHasIngredient|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildArticleHasIngredientQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ArticleHasIngredientTableMap::COL_ARTICLE_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ArticleHasIngredientTableMap::COL_INGREDIENT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildArticleHasIngredientQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ArticleHasIngredientTableMap::COL_ARTICLE_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ArticleHasIngredientTableMap::COL_INGREDIENT_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the article_id column
     *
     * Example usage:
     * <code>
     * $query->filterByArticleId('fooValue');   // WHERE article_id = 'fooValue'
     * $query->filterByArticleId('%fooValue%', Criteria::LIKE); // WHERE article_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $articleId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleHasIngredientQuery The current query, for fluid interface
     */
    public function filterByArticleId($articleId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($articleId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleHasIngredientTableMap::COL_ARTICLE_ID, $articleId, $comparison);
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
     * @return $this|ChildArticleHasIngredientQuery The current query, for fluid interface
     */
    public function filterByIngredientId($ingredientId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ingredientId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleHasIngredientTableMap::COL_INGREDIENT_ID, $ingredientId, $comparison);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleHasIngredientQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(ArticleHasIngredientTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ArticleHasIngredientTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleHasIngredientTableMap::COL_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query by a related \Article object
     *
     * @param \Article|ObjectCollection $article The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildArticleHasIngredientQuery The current query, for fluid interface
     */
    public function filterByArticle($article, $comparison = null)
    {
        if ($article instanceof \Article) {
            return $this
                ->addUsingAlias(ArticleHasIngredientTableMap::COL_ARTICLE_ID, $article->getArticleId(), $comparison);
        } elseif ($article instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ArticleHasIngredientTableMap::COL_ARTICLE_ID, $article->toKeyValue('PrimaryKey', 'ArticleId'), $comparison);
        } else {
            throw new PropelException('filterByArticle() only accepts arguments of type \Article or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Article relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArticleHasIngredientQuery The current query, for fluid interface
     */
    public function joinArticle($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Article');

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
            $this->addJoinObject($join, 'Article');
        }

        return $this;
    }

    /**
     * Use the Article relation Article object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ArticleQuery A secondary query class using the current class as primary query
     */
    public function useArticleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinArticle($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Article', '\ArticleQuery');
    }

    /**
     * Filter the query by a related \Ingredient object
     *
     * @param \Ingredient|ObjectCollection $ingredient The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildArticleHasIngredientQuery The current query, for fluid interface
     */
    public function filterByIngredient($ingredient, $comparison = null)
    {
        if ($ingredient instanceof \Ingredient) {
            return $this
                ->addUsingAlias(ArticleHasIngredientTableMap::COL_INGREDIENT_ID, $ingredient->getIngredientId(), $comparison);
        } elseif ($ingredient instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ArticleHasIngredientTableMap::COL_INGREDIENT_ID, $ingredient->toKeyValue('PrimaryKey', 'IngredientId'), $comparison);
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
     * @return $this|ChildArticleHasIngredientQuery The current query, for fluid interface
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
     * @param   ChildArticleHasIngredient $articleHasIngredient Object to remove from the list of results
     *
     * @return $this|ChildArticleHasIngredientQuery The current query, for fluid interface
     */
    public function prune($articleHasIngredient = null)
    {
        if ($articleHasIngredient) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ArticleHasIngredientTableMap::COL_ARTICLE_ID), $articleHasIngredient->getArticleId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ArticleHasIngredientTableMap::COL_INGREDIENT_ID), $articleHasIngredient->getIngredientId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the article_has_ingredient table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArticleHasIngredientTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ArticleHasIngredientTableMap::clearInstancePool();
            ArticleHasIngredientTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ArticleHasIngredientTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ArticleHasIngredientTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ArticleHasIngredientTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ArticleHasIngredientTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ArticleHasIngredientQuery
