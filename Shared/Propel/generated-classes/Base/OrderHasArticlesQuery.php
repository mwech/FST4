<?php

namespace Base;

use \OrderHasArticles as ChildOrderHasArticles;
use \OrderHasArticlesQuery as ChildOrderHasArticlesQuery;
use \Exception;
use \PDO;
use Map\OrderHasArticlesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'order_has_articles' table.
 *
 *
 *
 * @method     ChildOrderHasArticlesQuery orderByOrderId($order = Criteria::ASC) Order by the order_id column
 * @method     ChildOrderHasArticlesQuery orderByArticleId($order = Criteria::ASC) Order by the article_id column
 * @method     ChildOrderHasArticlesQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 *
 * @method     ChildOrderHasArticlesQuery groupByOrderId() Group by the order_id column
 * @method     ChildOrderHasArticlesQuery groupByArticleId() Group by the article_id column
 * @method     ChildOrderHasArticlesQuery groupByAmount() Group by the amount column
 *
 * @method     ChildOrderHasArticlesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrderHasArticlesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrderHasArticlesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrderHasArticlesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrderHasArticlesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrderHasArticlesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrderHasArticlesQuery leftJoinArticle($relationAlias = null) Adds a LEFT JOIN clause to the query using the Article relation
 * @method     ChildOrderHasArticlesQuery rightJoinArticle($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Article relation
 * @method     ChildOrderHasArticlesQuery innerJoinArticle($relationAlias = null) Adds a INNER JOIN clause to the query using the Article relation
 *
 * @method     ChildOrderHasArticlesQuery joinWithArticle($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Article relation
 *
 * @method     ChildOrderHasArticlesQuery leftJoinWithArticle() Adds a LEFT JOIN clause and with to the query using the Article relation
 * @method     ChildOrderHasArticlesQuery rightJoinWithArticle() Adds a RIGHT JOIN clause and with to the query using the Article relation
 * @method     ChildOrderHasArticlesQuery innerJoinWithArticle() Adds a INNER JOIN clause and with to the query using the Article relation
 *
 * @method     ChildOrderHasArticlesQuery leftJoinOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Order relation
 * @method     ChildOrderHasArticlesQuery rightJoinOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Order relation
 * @method     ChildOrderHasArticlesQuery innerJoinOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the Order relation
 *
 * @method     ChildOrderHasArticlesQuery joinWithOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Order relation
 *
 * @method     ChildOrderHasArticlesQuery leftJoinWithOrder() Adds a LEFT JOIN clause and with to the query using the Order relation
 * @method     ChildOrderHasArticlesQuery rightJoinWithOrder() Adds a RIGHT JOIN clause and with to the query using the Order relation
 * @method     ChildOrderHasArticlesQuery innerJoinWithOrder() Adds a INNER JOIN clause and with to the query using the Order relation
 *
 * @method     \ArticleQuery|\OrderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrderHasArticles findOne(ConnectionInterface $con = null) Return the first ChildOrderHasArticles matching the query
 * @method     ChildOrderHasArticles findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrderHasArticles matching the query, or a new ChildOrderHasArticles object populated from the query conditions when no match is found
 *
 * @method     ChildOrderHasArticles findOneByOrderId(string $order_id) Return the first ChildOrderHasArticles filtered by the order_id column
 * @method     ChildOrderHasArticles findOneByArticleId(string $article_id) Return the first ChildOrderHasArticles filtered by the article_id column
 * @method     ChildOrderHasArticles findOneByAmount(int $amount) Return the first ChildOrderHasArticles filtered by the amount column *

 * @method     ChildOrderHasArticles requirePk($key, ConnectionInterface $con = null) Return the ChildOrderHasArticles by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHasArticles requireOne(ConnectionInterface $con = null) Return the first ChildOrderHasArticles matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderHasArticles requireOneByOrderId(string $order_id) Return the first ChildOrderHasArticles filtered by the order_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHasArticles requireOneByArticleId(string $article_id) Return the first ChildOrderHasArticles filtered by the article_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHasArticles requireOneByAmount(int $amount) Return the first ChildOrderHasArticles filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderHasArticles[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrderHasArticles objects based on current ModelCriteria
 * @method     ChildOrderHasArticles[]|ObjectCollection findByOrderId(string $order_id) Return ChildOrderHasArticles objects filtered by the order_id column
 * @method     ChildOrderHasArticles[]|ObjectCollection findByArticleId(string $article_id) Return ChildOrderHasArticles objects filtered by the article_id column
 * @method     ChildOrderHasArticles[]|ObjectCollection findByAmount(int $amount) Return ChildOrderHasArticles objects filtered by the amount column
 * @method     ChildOrderHasArticles[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrderHasArticlesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OrderHasArticlesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\OrderHasArticles', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrderHasArticlesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrderHasArticlesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrderHasArticlesQuery) {
            return $criteria;
        }
        $query = new ChildOrderHasArticlesQuery();
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
     * @param array[$order_id, $article_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildOrderHasArticles|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderHasArticlesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrderHasArticlesTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildOrderHasArticles A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT order_id, article_id, amount FROM order_has_articles WHERE order_id = :p0 AND article_id = :p1';
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
            /** @var ChildOrderHasArticles $obj */
            $obj = new ChildOrderHasArticles();
            $obj->hydrate($row);
            OrderHasArticlesTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildOrderHasArticles|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOrderHasArticlesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(OrderHasArticlesTableMap::COL_ORDER_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(OrderHasArticlesTableMap::COL_ARTICLE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrderHasArticlesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(OrderHasArticlesTableMap::COL_ORDER_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(OrderHasArticlesTableMap::COL_ARTICLE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the order_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderId('fooValue');   // WHERE order_id = 'fooValue'
     * $query->filterByOrderId('%fooValue%', Criteria::LIKE); // WHERE order_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $orderId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderHasArticlesQuery The current query, for fluid interface
     */
    public function filterByOrderId($orderId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orderId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHasArticlesTableMap::COL_ORDER_ID, $orderId, $comparison);
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
     * @return $this|ChildOrderHasArticlesQuery The current query, for fluid interface
     */
    public function filterByArticleId($articleId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($articleId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHasArticlesTableMap::COL_ARTICLE_ID, $articleId, $comparison);
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
     * @return $this|ChildOrderHasArticlesQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(OrderHasArticlesTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(OrderHasArticlesTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHasArticlesTableMap::COL_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query by a related \Article object
     *
     * @param \Article|ObjectCollection $article The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderHasArticlesQuery The current query, for fluid interface
     */
    public function filterByArticle($article, $comparison = null)
    {
        if ($article instanceof \Article) {
            return $this
                ->addUsingAlias(OrderHasArticlesTableMap::COL_ARTICLE_ID, $article->getArticleId(), $comparison);
        } elseif ($article instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderHasArticlesTableMap::COL_ARTICLE_ID, $article->toKeyValue('PrimaryKey', 'ArticleId'), $comparison);
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
     * @return $this|ChildOrderHasArticlesQuery The current query, for fluid interface
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
     * Filter the query by a related \Order object
     *
     * @param \Order|ObjectCollection $order The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderHasArticlesQuery The current query, for fluid interface
     */
    public function filterByOrder($order, $comparison = null)
    {
        if ($order instanceof \Order) {
            return $this
                ->addUsingAlias(OrderHasArticlesTableMap::COL_ORDER_ID, $order->getOrderId(), $comparison);
        } elseif ($order instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderHasArticlesTableMap::COL_ORDER_ID, $order->toKeyValue('PrimaryKey', 'OrderId'), $comparison);
        } else {
            throw new PropelException('filterByOrder() only accepts arguments of type \Order or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Order relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderHasArticlesQuery The current query, for fluid interface
     */
    public function joinOrder($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Order');

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
            $this->addJoinObject($join, 'Order');
        }

        return $this;
    }

    /**
     * Use the Order relation Order object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderQuery A secondary query class using the current class as primary query
     */
    public function useOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Order', '\OrderQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildOrderHasArticles $orderHasArticles Object to remove from the list of results
     *
     * @return $this|ChildOrderHasArticlesQuery The current query, for fluid interface
     */
    public function prune($orderHasArticles = null)
    {
        if ($orderHasArticles) {
            $this->addCond('pruneCond0', $this->getAliasedColName(OrderHasArticlesTableMap::COL_ORDER_ID), $orderHasArticles->getOrderId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(OrderHasArticlesTableMap::COL_ARTICLE_ID), $orderHasArticles->getArticleId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the order_has_articles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderHasArticlesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrderHasArticlesTableMap::clearInstancePool();
            OrderHasArticlesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderHasArticlesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrderHasArticlesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrderHasArticlesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrderHasArticlesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrderHasArticlesQuery
