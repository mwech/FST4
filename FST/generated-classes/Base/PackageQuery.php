<?php

namespace Base;

use \Package as ChildPackage;
use \PackageQuery as ChildPackageQuery;
use \Exception;
use \PDO;
use Map\PackageTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'package' table.
 *
 *
 *
 * @method     ChildPackageQuery orderByPackageId($order = Criteria::ASC) Order by the package_id column
 * @method     ChildPackageQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildPackageQuery orderByPrice($order = Criteria::ASC) Order by the price column
 *
 * @method     ChildPackageQuery groupByPackageId() Group by the package_id column
 * @method     ChildPackageQuery groupByDescription() Group by the description column
 * @method     ChildPackageQuery groupByPrice() Group by the price column
 *
 * @method     ChildPackageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPackageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPackageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPackageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPackageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPackageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPackageQuery leftJoinPackageHasArticles($relationAlias = null) Adds a LEFT JOIN clause to the query using the PackageHasArticles relation
 * @method     ChildPackageQuery rightJoinPackageHasArticles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PackageHasArticles relation
 * @method     ChildPackageQuery innerJoinPackageHasArticles($relationAlias = null) Adds a INNER JOIN clause to the query using the PackageHasArticles relation
 *
 * @method     ChildPackageQuery joinWithPackageHasArticles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PackageHasArticles relation
 *
 * @method     ChildPackageQuery leftJoinWithPackageHasArticles() Adds a LEFT JOIN clause and with to the query using the PackageHasArticles relation
 * @method     ChildPackageQuery rightJoinWithPackageHasArticles() Adds a RIGHT JOIN clause and with to the query using the PackageHasArticles relation
 * @method     ChildPackageQuery innerJoinWithPackageHasArticles() Adds a INNER JOIN clause and with to the query using the PackageHasArticles relation
 *
 * @method     \PackageHasArticlesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPackage findOne(ConnectionInterface $con = null) Return the first ChildPackage matching the query
 * @method     ChildPackage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPackage matching the query, or a new ChildPackage object populated from the query conditions when no match is found
 *
 * @method     ChildPackage findOneByPackageId(int $package_id) Return the first ChildPackage filtered by the package_id column
 * @method     ChildPackage findOneByDescription(string $description) Return the first ChildPackage filtered by the description column
 * @method     ChildPackage findOneByPrice(double $price) Return the first ChildPackage filtered by the price column *

 * @method     ChildPackage requirePk($key, ConnectionInterface $con = null) Return the ChildPackage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackage requireOne(ConnectionInterface $con = null) Return the first ChildPackage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPackage requireOneByPackageId(int $package_id) Return the first ChildPackage filtered by the package_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackage requireOneByDescription(string $description) Return the first ChildPackage filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackage requireOneByPrice(double $price) Return the first ChildPackage filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPackage[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPackage objects based on current ModelCriteria
 * @method     ChildPackage[]|ObjectCollection findByPackageId(int $package_id) Return ChildPackage objects filtered by the package_id column
 * @method     ChildPackage[]|ObjectCollection findByDescription(string $description) Return ChildPackage objects filtered by the description column
 * @method     ChildPackage[]|ObjectCollection findByPrice(double $price) Return ChildPackage objects filtered by the price column
 * @method     ChildPackage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PackageQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PackageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\Package', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPackageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPackageQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPackageQuery) {
            return $criteria;
        }
        $query = new ChildPackageQuery();
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
     * @return ChildPackage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PackageTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PackageTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPackage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT package_id, description, price FROM package WHERE package_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPackage $obj */
            $obj = new ChildPackage();
            $obj->hydrate($row);
            PackageTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPackage|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPackageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PackageTableMap::COL_PACKAGE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPackageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PackageTableMap::COL_PACKAGE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the package_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPackageId(1234); // WHERE package_id = 1234
     * $query->filterByPackageId(array(12, 34)); // WHERE package_id IN (12, 34)
     * $query->filterByPackageId(array('min' => 12)); // WHERE package_id > 12
     * </code>
     *
     * @param     mixed $packageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackageQuery The current query, for fluid interface
     */
    public function filterByPackageId($packageId = null, $comparison = null)
    {
        if (is_array($packageId)) {
            $useMinMax = false;
            if (isset($packageId['min'])) {
                $this->addUsingAlias(PackageTableMap::COL_PACKAGE_ID, $packageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($packageId['max'])) {
                $this->addUsingAlias(PackageTableMap::COL_PACKAGE_ID, $packageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackageTableMap::COL_PACKAGE_ID, $packageId, $comparison);
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
     * @return $this|ChildPackageQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackageTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildPackageQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(PackageTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(PackageTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackageTableMap::COL_PRICE, $price, $comparison);
    }

    /**
     * Filter the query by a related \PackageHasArticles object
     *
     * @param \PackageHasArticles|ObjectCollection $packageHasArticles the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPackageQuery The current query, for fluid interface
     */
    public function filterByPackageHasArticles($packageHasArticles, $comparison = null)
    {
        if ($packageHasArticles instanceof \PackageHasArticles) {
            return $this
                ->addUsingAlias(PackageTableMap::COL_PACKAGE_ID, $packageHasArticles->getPackageId(), $comparison);
        } elseif ($packageHasArticles instanceof ObjectCollection) {
            return $this
                ->usePackageHasArticlesQuery()
                ->filterByPrimaryKeys($packageHasArticles->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPackageHasArticles() only accepts arguments of type \PackageHasArticles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PackageHasArticles relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPackageQuery The current query, for fluid interface
     */
    public function joinPackageHasArticles($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PackageHasArticles');

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
            $this->addJoinObject($join, 'PackageHasArticles');
        }

        return $this;
    }

    /**
     * Use the PackageHasArticles relation PackageHasArticles object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PackageHasArticlesQuery A secondary query class using the current class as primary query
     */
    public function usePackageHasArticlesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPackageHasArticles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PackageHasArticles', '\PackageHasArticlesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPackage $package Object to remove from the list of results
     *
     * @return $this|ChildPackageQuery The current query, for fluid interface
     */
    public function prune($package = null)
    {
        if ($package) {
            $this->addUsingAlias(PackageTableMap::COL_PACKAGE_ID, $package->getPackageId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the package table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PackageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PackageTableMap::clearInstancePool();
            PackageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PackageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PackageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PackageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PackageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PackageQuery
