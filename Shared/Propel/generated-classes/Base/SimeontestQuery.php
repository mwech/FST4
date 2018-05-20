<?php

namespace Base;

use \Simeontest as ChildSimeontest;
use \SimeontestQuery as ChildSimeontestQuery;
use \Exception;
use \PDO;
use Map\SimeontestTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'simeontest' table.
 *
 *
 *
 * @method     ChildSimeontestQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSimeontestQuery orderByStartdate($order = Criteria::ASC) Order by the startdate column
 * @method     ChildSimeontestQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildSimeontestQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildSimeontestQuery orderByUsed($order = Criteria::ASC) Order by the used column
 * @method     ChildSimeontestQuery orderByVisible($order = Criteria::ASC) Order by the visible column
 * @method     ChildSimeontestQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     ChildSimeontestQuery groupById() Group by the id column
 * @method     ChildSimeontestQuery groupByStartdate() Group by the startdate column
 * @method     ChildSimeontestQuery groupByAmount() Group by the amount column
 * @method     ChildSimeontestQuery groupByPrice() Group by the price column
 * @method     ChildSimeontestQuery groupByUsed() Group by the used column
 * @method     ChildSimeontestQuery groupByVisible() Group by the visible column
 * @method     ChildSimeontestQuery groupByDescription() Group by the description column
 *
 * @method     ChildSimeontestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSimeontestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSimeontestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSimeontestQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSimeontestQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSimeontestQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSimeontest findOne(ConnectionInterface $con = null) Return the first ChildSimeontest matching the query
 * @method     ChildSimeontest findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSimeontest matching the query, or a new ChildSimeontest object populated from the query conditions when no match is found
 *
 * @method     ChildSimeontest findOneById(string $id) Return the first ChildSimeontest filtered by the id column
 * @method     ChildSimeontest findOneByStartdate(string $startdate) Return the first ChildSimeontest filtered by the startdate column
 * @method     ChildSimeontest findOneByAmount(int $amount) Return the first ChildSimeontest filtered by the amount column
 * @method     ChildSimeontest findOneByPrice(double $price) Return the first ChildSimeontest filtered by the price column
 * @method     ChildSimeontest findOneByUsed(string $used) Return the first ChildSimeontest filtered by the used column
 * @method     ChildSimeontest findOneByVisible(string $visible) Return the first ChildSimeontest filtered by the visible column
 * @method     ChildSimeontest findOneByDescription(string $description) Return the first ChildSimeontest filtered by the description column *

 * @method     ChildSimeontest requirePk($key, ConnectionInterface $con = null) Return the ChildSimeontest by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSimeontest requireOne(ConnectionInterface $con = null) Return the first ChildSimeontest matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSimeontest requireOneById(string $id) Return the first ChildSimeontest filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSimeontest requireOneByStartdate(string $startdate) Return the first ChildSimeontest filtered by the startdate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSimeontest requireOneByAmount(int $amount) Return the first ChildSimeontest filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSimeontest requireOneByPrice(double $price) Return the first ChildSimeontest filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSimeontest requireOneByUsed(string $used) Return the first ChildSimeontest filtered by the used column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSimeontest requireOneByVisible(string $visible) Return the first ChildSimeontest filtered by the visible column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSimeontest requireOneByDescription(string $description) Return the first ChildSimeontest filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSimeontest[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSimeontest objects based on current ModelCriteria
 * @method     ChildSimeontest[]|ObjectCollection findById(string $id) Return ChildSimeontest objects filtered by the id column
 * @method     ChildSimeontest[]|ObjectCollection findByStartdate(string $startdate) Return ChildSimeontest objects filtered by the startdate column
 * @method     ChildSimeontest[]|ObjectCollection findByAmount(int $amount) Return ChildSimeontest objects filtered by the amount column
 * @method     ChildSimeontest[]|ObjectCollection findByPrice(double $price) Return ChildSimeontest objects filtered by the price column
 * @method     ChildSimeontest[]|ObjectCollection findByUsed(string $used) Return ChildSimeontest objects filtered by the used column
 * @method     ChildSimeontest[]|ObjectCollection findByVisible(string $visible) Return ChildSimeontest objects filtered by the visible column
 * @method     ChildSimeontest[]|ObjectCollection findByDescription(string $description) Return ChildSimeontest objects filtered by the description column
 * @method     ChildSimeontest[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SimeontestQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SimeontestQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\Simeontest', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSimeontestQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSimeontestQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSimeontestQuery) {
            return $criteria;
        }
        $query = new ChildSimeontestQuery();
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
     * @return ChildSimeontest|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SimeontestTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SimeontestTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSimeontest A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, startdate, amount, price, used, visible, description FROM simeontest WHERE id = :p0';
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
            /** @var ChildSimeontest $obj */
            $obj = new ChildSimeontest();
            $obj->hydrate($row);
            SimeontestTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSimeontest|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSimeontestQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SimeontestTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSimeontestQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SimeontestTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSimeontestQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SimeontestTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the startdate column
     *
     * Example usage:
     * <code>
     * $query->filterByStartdate('2011-03-14'); // WHERE startdate = '2011-03-14'
     * $query->filterByStartdate('now'); // WHERE startdate = '2011-03-14'
     * $query->filterByStartdate(array('max' => 'yesterday')); // WHERE startdate > '2011-03-13'
     * </code>
     *
     * @param     mixed $startdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSimeontestQuery The current query, for fluid interface
     */
    public function filterByStartdate($startdate = null, $comparison = null)
    {
        if (is_array($startdate)) {
            $useMinMax = false;
            if (isset($startdate['min'])) {
                $this->addUsingAlias(SimeontestTableMap::COL_STARTDATE, $startdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startdate['max'])) {
                $this->addUsingAlias(SimeontestTableMap::COL_STARTDATE, $startdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SimeontestTableMap::COL_STARTDATE, $startdate, $comparison);
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
     * @return $this|ChildSimeontestQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(SimeontestTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(SimeontestTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SimeontestTableMap::COL_AMOUNT, $amount, $comparison);
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
     * @return $this|ChildSimeontestQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(SimeontestTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(SimeontestTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SimeontestTableMap::COL_PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the used column
     *
     * Example usage:
     * <code>
     * $query->filterByUsed('fooValue');   // WHERE used = 'fooValue'
     * $query->filterByUsed('%fooValue%', Criteria::LIKE); // WHERE used LIKE '%fooValue%'
     * </code>
     *
     * @param     string $used The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSimeontestQuery The current query, for fluid interface
     */
    public function filterByUsed($used = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($used)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SimeontestTableMap::COL_USED, $used, $comparison);
    }

    /**
     * Filter the query on the visible column
     *
     * Example usage:
     * <code>
     * $query->filterByVisible('fooValue');   // WHERE visible = 'fooValue'
     * $query->filterByVisible('%fooValue%', Criteria::LIKE); // WHERE visible LIKE '%fooValue%'
     * </code>
     *
     * @param     string $visible The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSimeontestQuery The current query, for fluid interface
     */
    public function filterByVisible($visible = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($visible)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SimeontestTableMap::COL_VISIBLE, $visible, $comparison);
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
     * @return $this|ChildSimeontestQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SimeontestTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSimeontest $simeontest Object to remove from the list of results
     *
     * @return $this|ChildSimeontestQuery The current query, for fluid interface
     */
    public function prune($simeontest = null)
    {
        if ($simeontest) {
            $this->addUsingAlias(SimeontestTableMap::COL_ID, $simeontest->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the simeontest table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SimeontestTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SimeontestTableMap::clearInstancePool();
            SimeontestTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SimeontestTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SimeontestTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SimeontestTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SimeontestTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SimeontestQuery
