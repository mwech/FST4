<?php

namespace Base;

use \Business customer as ChildBusiness customer;
use \Business customerQuery as ChildBusiness customerQuery;
use \Exception;
use \PDO;
use Map\Business customerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'business customer' table.
 *
 *
 *
 * @method     ChildBusiness customerQuery orderByVatNr($order = Criteria::ASC) Order by the VAT_Nr column
 * @method     ChildBusiness customerQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildBusiness customerQuery orderByPersonId($order = Criteria::ASC) Order by the person_id column
 *
 * @method     ChildBusiness customerQuery groupByVatNr() Group by the VAT_Nr column
 * @method     ChildBusiness customerQuery groupByDescription() Group by the description column
 * @method     ChildBusiness customerQuery groupByPersonId() Group by the person_id column
 *
 * @method     ChildBusiness customerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBusiness customerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBusiness customerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBusiness customerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBusiness customerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBusiness customerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBusiness customerQuery leftJoinPerson($relationAlias = null) Adds a LEFT JOIN clause to the query using the Person relation
 * @method     ChildBusiness customerQuery rightJoinPerson($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Person relation
 * @method     ChildBusiness customerQuery innerJoinPerson($relationAlias = null) Adds a INNER JOIN clause to the query using the Person relation
 *
 * @method     ChildBusiness customerQuery joinWithPerson($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Person relation
 *
 * @method     ChildBusiness customerQuery leftJoinWithPerson() Adds a LEFT JOIN clause and with to the query using the Person relation
 * @method     ChildBusiness customerQuery rightJoinWithPerson() Adds a RIGHT JOIN clause and with to the query using the Person relation
 * @method     ChildBusiness customerQuery innerJoinWithPerson() Adds a INNER JOIN clause and with to the query using the Person relation
 *
 * @method     \PersonQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBusiness customer findOne(ConnectionInterface $con = null) Return the first ChildBusiness customer matching the query
 * @method     ChildBusiness customer findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBusiness customer matching the query, or a new ChildBusiness customer object populated from the query conditions when no match is found
 *
 * @method     ChildBusiness customer findOneByVatNr(string $VAT_Nr) Return the first ChildBusiness customer filtered by the VAT_Nr column
 * @method     ChildBusiness customer findOneByDescription(string $description) Return the first ChildBusiness customer filtered by the description column
 * @method     ChildBusiness customer findOneByPersonId(string $person_id) Return the first ChildBusiness customer filtered by the person_id column *

 * @method     ChildBusiness customer requirePk($key, ConnectionInterface $con = null) Return the ChildBusiness customer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBusiness customer requireOne(ConnectionInterface $con = null) Return the first ChildBusiness customer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBusiness customer requireOneByVatNr(string $VAT_Nr) Return the first ChildBusiness customer filtered by the VAT_Nr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBusiness customer requireOneByDescription(string $description) Return the first ChildBusiness customer filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBusiness customer requireOneByPersonId(string $person_id) Return the first ChildBusiness customer filtered by the person_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBusiness customer[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBusiness customer objects based on current ModelCriteria
 * @method     ChildBusiness customer[]|ObjectCollection findByVatNr(string $VAT_Nr) Return ChildBusiness customer objects filtered by the VAT_Nr column
 * @method     ChildBusiness customer[]|ObjectCollection findByDescription(string $description) Return ChildBusiness customer objects filtered by the description column
 * @method     ChildBusiness customer[]|ObjectCollection findByPersonId(string $person_id) Return ChildBusiness customer objects filtered by the person_id column
 * @method     ChildBusiness customer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class Business customerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\Business customerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\Business customer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBusiness customerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBusiness customerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBusiness customerQuery) {
            return $criteria;
        }
        $query = new ChildBusiness customerQuery();
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
     * @return ChildBusiness customer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(Business customerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = Business customerTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBusiness customer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT VAT_Nr, description, person_id FROM business customer WHERE VAT_Nr = :p0';
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
            /** @var ChildBusiness customer $obj */
            $obj = new ChildBusiness customer();
            $obj->hydrate($row);
            Business customerTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBusiness customer|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBusiness customerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(Business customerTableMap::COL_VAT_NR, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBusiness customerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(Business customerTableMap::COL_VAT_NR, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the VAT_Nr column
     *
     * Example usage:
     * <code>
     * $query->filterByVatNr('fooValue');   // WHERE VAT_Nr = 'fooValue'
     * $query->filterByVatNr('%fooValue%', Criteria::LIKE); // WHERE VAT_Nr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $vatNr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBusiness customerQuery The current query, for fluid interface
     */
    public function filterByVatNr($vatNr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($vatNr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(Business customerTableMap::COL_VAT_NR, $vatNr, $comparison);
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
     * @return $this|ChildBusiness customerQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(Business customerTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildBusiness customerQuery The current query, for fluid interface
     */
    public function filterByPersonId($personId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($personId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(Business customerTableMap::COL_PERSON_ID, $personId, $comparison);
    }

    /**
     * Filter the query by a related \Person object
     *
     * @param \Person|ObjectCollection $person The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBusiness customerQuery The current query, for fluid interface
     */
    public function filterByPerson($person, $comparison = null)
    {
        if ($person instanceof \Person) {
            return $this
                ->addUsingAlias(Business customerTableMap::COL_PERSON_ID, $person->getPersonId(), $comparison);
        } elseif ($person instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(Business customerTableMap::COL_PERSON_ID, $person->toKeyValue('PrimaryKey', 'PersonId'), $comparison);
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
     * @return $this|ChildBusiness customerQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildBusiness customer $business customer Object to remove from the list of results
     *
     * @return $this|ChildBusiness customerQuery The current query, for fluid interface
     */
    public function prune($business customer = null)
    {
        if ($business customer) {
            $this->addUsingAlias(Business customerTableMap::COL_VAT_NR, $business customer->getVatNr(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the business customer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(Business customerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            Business customerTableMap::clearInstancePool();
            Business customerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(Business customerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(Business customerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            Business customerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            Business customerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // Business customerQuery
