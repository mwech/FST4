<?php

namespace Base;

use \SpecialOffer as ChildSpecialOffer;
use \SpecialOfferQuery as ChildSpecialOfferQuery;
use \Exception;
use \PDO;
use Map\SpecialOfferTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'special_offer' table.
 *
 *
 *
 * @method     ChildSpecialOfferQuery orderBySpecialOfferId($order = Criteria::ASC) Order by the special_offer_id column
 * @method     ChildSpecialOfferQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildSpecialOfferQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildSpecialOfferQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method     ChildSpecialOfferQuery orderByPercentage($order = Criteria::ASC) Order by the percentage column
 *
 * @method     ChildSpecialOfferQuery groupBySpecialOfferId() Group by the special_offer_id column
 * @method     ChildSpecialOfferQuery groupByCode() Group by the code column
 * @method     ChildSpecialOfferQuery groupByStartDate() Group by the start_date column
 * @method     ChildSpecialOfferQuery groupByEndDate() Group by the end_date column
 * @method     ChildSpecialOfferQuery groupByPercentage() Group by the percentage column
 *
 * @method     ChildSpecialOfferQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpecialOfferQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpecialOfferQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpecialOfferQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpecialOfferQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpecialOfferQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpecialOffer findOne(ConnectionInterface $con = null) Return the first ChildSpecialOffer matching the query
 * @method     ChildSpecialOffer findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSpecialOffer matching the query, or a new ChildSpecialOffer object populated from the query conditions when no match is found
 *
 * @method     ChildSpecialOffer findOneBySpecialOfferId(string $special_offer_id) Return the first ChildSpecialOffer filtered by the special_offer_id column
 * @method     ChildSpecialOffer findOneByCode(string $code) Return the first ChildSpecialOffer filtered by the code column
 * @method     ChildSpecialOffer findOneByStartDate(string $start_date) Return the first ChildSpecialOffer filtered by the start_date column
 * @method     ChildSpecialOffer findOneByEndDate(string $end_date) Return the first ChildSpecialOffer filtered by the end_date column
 * @method     ChildSpecialOffer findOneByPercentage(double $percentage) Return the first ChildSpecialOffer filtered by the percentage column *

 * @method     ChildSpecialOffer requirePk($key, ConnectionInterface $con = null) Return the ChildSpecialOffer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpecialOffer requireOne(ConnectionInterface $con = null) Return the first ChildSpecialOffer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpecialOffer requireOneBySpecialOfferId(string $special_offer_id) Return the first ChildSpecialOffer filtered by the special_offer_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpecialOffer requireOneByCode(string $code) Return the first ChildSpecialOffer filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpecialOffer requireOneByStartDate(string $start_date) Return the first ChildSpecialOffer filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpecialOffer requireOneByEndDate(string $end_date) Return the first ChildSpecialOffer filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpecialOffer requireOneByPercentage(double $percentage) Return the first ChildSpecialOffer filtered by the percentage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpecialOffer[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSpecialOffer objects based on current ModelCriteria
 * @method     ChildSpecialOffer[]|ObjectCollection findBySpecialOfferId(string $special_offer_id) Return ChildSpecialOffer objects filtered by the special_offer_id column
 * @method     ChildSpecialOffer[]|ObjectCollection findByCode(string $code) Return ChildSpecialOffer objects filtered by the code column
 * @method     ChildSpecialOffer[]|ObjectCollection findByStartDate(string $start_date) Return ChildSpecialOffer objects filtered by the start_date column
 * @method     ChildSpecialOffer[]|ObjectCollection findByEndDate(string $end_date) Return ChildSpecialOffer objects filtered by the end_date column
 * @method     ChildSpecialOffer[]|ObjectCollection findByPercentage(double $percentage) Return ChildSpecialOffer objects filtered by the percentage column
 * @method     ChildSpecialOffer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SpecialOfferQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SpecialOfferQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\SpecialOffer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpecialOfferQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpecialOfferQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSpecialOfferQuery) {
            return $criteria;
        }
        $query = new ChildSpecialOfferQuery();
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
     * @return ChildSpecialOffer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SpecialOfferTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SpecialOfferTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpecialOffer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT special_offer_id, code, start_date, end_date, percentage FROM special_offer WHERE special_offer_id = :p0';
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
            /** @var ChildSpecialOffer $obj */
            $obj = new ChildSpecialOffer();
            $obj->hydrate($row);
            SpecialOfferTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpecialOffer|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSpecialOfferQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SpecialOfferTableMap::COL_SPECIAL_OFFER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSpecialOfferQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SpecialOfferTableMap::COL_SPECIAL_OFFER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the special_offer_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySpecialOfferId('fooValue');   // WHERE special_offer_id = 'fooValue'
     * $query->filterBySpecialOfferId('%fooValue%', Criteria::LIKE); // WHERE special_offer_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $specialOfferId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSpecialOfferQuery The current query, for fluid interface
     */
    public function filterBySpecialOfferId($specialOfferId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($specialOfferId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SpecialOfferTableMap::COL_SPECIAL_OFFER_ID, $specialOfferId, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSpecialOfferQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SpecialOfferTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('2011-03-14'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate('now'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate(array('max' => 'yesterday')); // WHERE start_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $startDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSpecialOfferQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(SpecialOfferTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(SpecialOfferTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SpecialOfferTableMap::COL_START_DATE, $startDate, $comparison);
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('2011-03-14'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate('now'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate(array('max' => 'yesterday')); // WHERE end_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $endDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSpecialOfferQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(SpecialOfferTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(SpecialOfferTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SpecialOfferTableMap::COL_END_DATE, $endDate, $comparison);
    }

    /**
     * Filter the query on the percentage column
     *
     * Example usage:
     * <code>
     * $query->filterByPercentage(1234); // WHERE percentage = 1234
     * $query->filterByPercentage(array(12, 34)); // WHERE percentage IN (12, 34)
     * $query->filterByPercentage(array('min' => 12)); // WHERE percentage > 12
     * </code>
     *
     * @param     mixed $percentage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSpecialOfferQuery The current query, for fluid interface
     */
    public function filterByPercentage($percentage = null, $comparison = null)
    {
        if (is_array($percentage)) {
            $useMinMax = false;
            if (isset($percentage['min'])) {
                $this->addUsingAlias(SpecialOfferTableMap::COL_PERCENTAGE, $percentage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($percentage['max'])) {
                $this->addUsingAlias(SpecialOfferTableMap::COL_PERCENTAGE, $percentage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SpecialOfferTableMap::COL_PERCENTAGE, $percentage, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSpecialOffer $specialOffer Object to remove from the list of results
     *
     * @return $this|ChildSpecialOfferQuery The current query, for fluid interface
     */
    public function prune($specialOffer = null)
    {
        if ($specialOffer) {
            $this->addUsingAlias(SpecialOfferTableMap::COL_SPECIAL_OFFER_ID, $specialOffer->getSpecialOfferId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the special_offer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpecialOfferTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpecialOfferTableMap::clearInstancePool();
            SpecialOfferTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpecialOfferTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpecialOfferTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpecialOfferTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpecialOfferTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SpecialOfferQuery
