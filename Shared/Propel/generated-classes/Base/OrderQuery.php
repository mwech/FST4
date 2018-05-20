<?php

namespace Base;

use \Order as ChildOrder;
use \OrderQuery as ChildOrderQuery;
use \Exception;
use \PDO;
use Map\OrderTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'order' table.
 *
 *
 *
 * @method     ChildOrderQuery orderByOrderId($order = Criteria::ASC) Order by the order_id column
 * @method     ChildOrderQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildOrderQuery orderByTotalAmount($order = Criteria::ASC) Order by the total_amount column
 * @method     ChildOrderQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildOrderQuery orderByPersonId($order = Criteria::ASC) Order by the person_id column
 * @method     ChildOrderQuery orderByVoucherId($order = Criteria::ASC) Order by the voucher_id column
 *
 * @method     ChildOrderQuery groupByOrderId() Group by the order_id column
 * @method     ChildOrderQuery groupByDate() Group by the date column
 * @method     ChildOrderQuery groupByTotalAmount() Group by the total_amount column
 * @method     ChildOrderQuery groupByStatus() Group by the status column
 * @method     ChildOrderQuery groupByPersonId() Group by the person_id column
 * @method     ChildOrderQuery groupByVoucherId() Group by the voucher_id column
 *
 * @method     ChildOrderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrderQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrderQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrderQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrderQuery leftJoinPerson($relationAlias = null) Adds a LEFT JOIN clause to the query using the Person relation
 * @method     ChildOrderQuery rightJoinPerson($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Person relation
 * @method     ChildOrderQuery innerJoinPerson($relationAlias = null) Adds a INNER JOIN clause to the query using the Person relation
 *
 * @method     ChildOrderQuery joinWithPerson($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Person relation
 *
 * @method     ChildOrderQuery leftJoinWithPerson() Adds a LEFT JOIN clause and with to the query using the Person relation
 * @method     ChildOrderQuery rightJoinWithPerson() Adds a RIGHT JOIN clause and with to the query using the Person relation
 * @method     ChildOrderQuery innerJoinWithPerson() Adds a INNER JOIN clause and with to the query using the Person relation
 *
 * @method     ChildOrderQuery leftJoinVoucher($relationAlias = null) Adds a LEFT JOIN clause to the query using the Voucher relation
 * @method     ChildOrderQuery rightJoinVoucher($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Voucher relation
 * @method     ChildOrderQuery innerJoinVoucher($relationAlias = null) Adds a INNER JOIN clause to the query using the Voucher relation
 *
 * @method     ChildOrderQuery joinWithVoucher($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Voucher relation
 *
 * @method     ChildOrderQuery leftJoinWithVoucher() Adds a LEFT JOIN clause and with to the query using the Voucher relation
 * @method     ChildOrderQuery rightJoinWithVoucher() Adds a RIGHT JOIN clause and with to the query using the Voucher relation
 * @method     ChildOrderQuery innerJoinWithVoucher() Adds a INNER JOIN clause and with to the query using the Voucher relation
 *
 * @method     ChildOrderQuery leftJoinOrderHasArticles($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderHasArticles relation
 * @method     ChildOrderQuery rightJoinOrderHasArticles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderHasArticles relation
 * @method     ChildOrderQuery innerJoinOrderHasArticles($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderHasArticles relation
 *
 * @method     ChildOrderQuery joinWithOrderHasArticles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderHasArticles relation
 *
 * @method     ChildOrderQuery leftJoinWithOrderHasArticles() Adds a LEFT JOIN clause and with to the query using the OrderHasArticles relation
 * @method     ChildOrderQuery rightJoinWithOrderHasArticles() Adds a RIGHT JOIN clause and with to the query using the OrderHasArticles relation
 * @method     ChildOrderQuery innerJoinWithOrderHasArticles() Adds a INNER JOIN clause and with to the query using the OrderHasArticles relation
 *
 * @method     \PersonQuery|\VoucherQuery|\OrderHasArticlesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrder findOne(ConnectionInterface $con = null) Return the first ChildOrder matching the query
 * @method     ChildOrder findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrder matching the query, or a new ChildOrder object populated from the query conditions when no match is found
 *
 * @method     ChildOrder findOneByOrderId(string $order_id) Return the first ChildOrder filtered by the order_id column
 * @method     ChildOrder findOneByDate(string $date) Return the first ChildOrder filtered by the date column
 * @method     ChildOrder findOneByTotalAmount(double $total_amount) Return the first ChildOrder filtered by the total_amount column
 * @method     ChildOrder findOneByStatus(string $status) Return the first ChildOrder filtered by the status column
 * @method     ChildOrder findOneByPersonId(string $person_id) Return the first ChildOrder filtered by the person_id column
 * @method     ChildOrder findOneByVoucherId(string $voucher_id) Return the first ChildOrder filtered by the voucher_id column *

 * @method     ChildOrder requirePk($key, ConnectionInterface $con = null) Return the ChildOrder by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOne(ConnectionInterface $con = null) Return the first ChildOrder matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrder requireOneByOrderId(string $order_id) Return the first ChildOrder filtered by the order_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByDate(string $date) Return the first ChildOrder filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByTotalAmount(double $total_amount) Return the first ChildOrder filtered by the total_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByStatus(string $status) Return the first ChildOrder filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByPersonId(string $person_id) Return the first ChildOrder filtered by the person_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByVoucherId(string $voucher_id) Return the first ChildOrder filtered by the voucher_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrder[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrder objects based on current ModelCriteria
 * @method     ChildOrder[]|ObjectCollection findByOrderId(string $order_id) Return ChildOrder objects filtered by the order_id column
 * @method     ChildOrder[]|ObjectCollection findByDate(string $date) Return ChildOrder objects filtered by the date column
 * @method     ChildOrder[]|ObjectCollection findByTotalAmount(double $total_amount) Return ChildOrder objects filtered by the total_amount column
 * @method     ChildOrder[]|ObjectCollection findByStatus(string $status) Return ChildOrder objects filtered by the status column
 * @method     ChildOrder[]|ObjectCollection findByPersonId(string $person_id) Return ChildOrder objects filtered by the person_id column
 * @method     ChildOrder[]|ObjectCollection findByVoucherId(string $voucher_id) Return ChildOrder objects filtered by the voucher_id column
 * @method     ChildOrder[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrderQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OrderQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\Order', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrderQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrderQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrderQuery) {
            return $criteria;
        }
        $query = new ChildOrderQuery();
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
     * @return ChildOrder|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrderTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOrder A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT order_id, date, total_amount, status, person_id, voucher_id FROM order WHERE order_id = :p0';
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
            /** @var ChildOrder $obj */
            $obj = new ChildOrder();
            $obj->hydrate($row);
            OrderTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOrder|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OrderTableMap::COL_ORDER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OrderTableMap::COL_ORDER_ID, $keys, Criteria::IN);
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
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByOrderId($orderId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orderId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_ORDER_ID, $orderId, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the total_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalAmount(1234); // WHERE total_amount = 1234
     * $query->filterByTotalAmount(array(12, 34)); // WHERE total_amount IN (12, 34)
     * $query->filterByTotalAmount(array('min' => 12)); // WHERE total_amount > 12
     * </code>
     *
     * @param     mixed $totalAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByTotalAmount($totalAmount = null, $comparison = null)
    {
        if (is_array($totalAmount)) {
            $useMinMax = false;
            if (isset($totalAmount['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_TOTAL_AMOUNT, $totalAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalAmount['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_TOTAL_AMOUNT, $totalAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_TOTAL_AMOUNT, $totalAmount, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the person_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonId('fooValue');   // WHERE person_id = 'fooValue'
     * $query->filterByPersonId('%fooValue%', Criteria::LIKE); // WHERE person_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $personId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByPersonId($personId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($personId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_PERSON_ID, $personId, $comparison);
    }

    /**
     * Filter the query on the voucher_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVoucherId('fooValue');   // WHERE voucher_id = 'fooValue'
     * $query->filterByVoucherId('%fooValue%', Criteria::LIKE); // WHERE voucher_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $voucherId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByVoucherId($voucherId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($voucherId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_VOUCHER_ID, $voucherId, $comparison);
    }

    /**
     * Filter the query by a related \Person object
     *
     * @param \Person|ObjectCollection $person The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderQuery The current query, for fluid interface
     */
    public function filterByPerson($person, $comparison = null)
    {
        if ($person instanceof \Person) {
            return $this
                ->addUsingAlias(OrderTableMap::COL_PERSON_ID, $person->getPersonId(), $comparison);
        } elseif ($person instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderTableMap::COL_PERSON_ID, $person->toKeyValue('PrimaryKey', 'PersonId'), $comparison);
        } else {
            throw new PropelException('filterByPerson() only accepts arguments of type \Person or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Person relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function joinPerson($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Person');

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
            $this->addJoinObject($join, 'Person');
        }

        return $this;
    }

    /**
     * Use the Person relation Person object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PersonQuery A secondary query class using the current class as primary query
     */
    public function usePersonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPerson($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Person', '\PersonQuery');
    }

    /**
     * Filter the query by a related \Voucher object
     *
     * @param \Voucher|ObjectCollection $voucher The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderQuery The current query, for fluid interface
     */
    public function filterByVoucher($voucher, $comparison = null)
    {
        if ($voucher instanceof \Voucher) {
            return $this
                ->addUsingAlias(OrderTableMap::COL_VOUCHER_ID, $voucher->getVoucherId(), $comparison);
        } elseif ($voucher instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderTableMap::COL_VOUCHER_ID, $voucher->toKeyValue('PrimaryKey', 'VoucherId'), $comparison);
        } else {
            throw new PropelException('filterByVoucher() only accepts arguments of type \Voucher or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Voucher relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function joinVoucher($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Voucher');

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
            $this->addJoinObject($join, 'Voucher');
        }

        return $this;
    }

    /**
     * Use the Voucher relation Voucher object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \VoucherQuery A secondary query class using the current class as primary query
     */
    public function useVoucherQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVoucher($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Voucher', '\VoucherQuery');
    }

    /**
     * Filter the query by a related \OrderHasArticles object
     *
     * @param \OrderHasArticles|ObjectCollection $orderHasArticles the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOrderQuery The current query, for fluid interface
     */
    public function filterByOrderHasArticles($orderHasArticles, $comparison = null)
    {
        if ($orderHasArticles instanceof \OrderHasArticles) {
            return $this
                ->addUsingAlias(OrderTableMap::COL_ORDER_ID, $orderHasArticles->getOrderId(), $comparison);
        } elseif ($orderHasArticles instanceof ObjectCollection) {
            return $this
                ->useOrderHasArticlesQuery()
                ->filterByPrimaryKeys($orderHasArticles->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrderHasArticles() only accepts arguments of type \OrderHasArticles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderHasArticles relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function joinOrderHasArticles($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderHasArticles');

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
            $this->addJoinObject($join, 'OrderHasArticles');
        }

        return $this;
    }

    /**
     * Use the OrderHasArticles relation OrderHasArticles object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderHasArticlesQuery A secondary query class using the current class as primary query
     */
    public function useOrderHasArticlesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderHasArticles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderHasArticles', '\OrderHasArticlesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildOrder $order Object to remove from the list of results
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function prune($order = null)
    {
        if ($order) {
            $this->addUsingAlias(OrderTableMap::COL_ORDER_ID, $order->getOrderId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the order table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrderTableMap::clearInstancePool();
            OrderTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrderTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrderTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrderTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrderQuery
