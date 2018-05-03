<?php

namespace Base;

use \PackageHasArticles as ChildPackageHasArticles;
use \PackageHasArticlesQuery as ChildPackageHasArticlesQuery;
use \Exception;
use \PDO;
use Map\PackageHasArticlesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'package_has_articles' table.
 *
 *
 *
 * @method     ChildPackageHasArticlesQuery orderByPackageId($order = Criteria::ASC) Order by the package_id column
 * @method     ChildPackageHasArticlesQuery orderByArticleId($order = Criteria::ASC) Order by the article_id column
 *
 * @method     ChildPackageHasArticlesQuery groupByPackageId() Group by the package_id column
 * @method     ChildPackageHasArticlesQuery groupByArticleId() Group by the article_id column
 *
 * @method     ChildPackageHasArticlesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPackageHasArticlesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPackageHasArticlesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPackageHasArticlesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPackageHasArticlesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPackageHasArticlesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPackageHasArticlesQuery leftJoinArticle($relationAlias = null) Adds a LEFT JOIN clause to the query using the Article relation
 * @method     ChildPackageHasArticlesQuery rightJoinArticle($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Article relation
 * @method     ChildPackageHasArticlesQuery innerJoinArticle($relationAlias = null) Adds a INNER JOIN clause to the query using the Article relation
 *
 * @method     ChildPackageHasArticlesQuery joinWithArticle($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Article relation
 *
 * @method     ChildPackageHasArticlesQuery leftJoinWithArticle() Adds a LEFT JOIN clause and with to the query using the Article relation
 * @method     ChildPackageHasArticlesQuery rightJoinWithArticle() Adds a RIGHT JOIN clause and with to the query using the Article relation
 * @method     ChildPackageHasArticlesQuery innerJoinWithArticle() Adds a INNER JOIN clause and with to the query using the Article relation
 *
 * @method     ChildPackageHasArticlesQuery leftJoinPackage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Package relation
 * @method     ChildPackageHasArticlesQuery rightJoinPackage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Package relation
 * @method     ChildPackageHasArticlesQuery innerJoinPackage($relationAlias = null) Adds a INNER JOIN clause to the query using the Package relation
 *
 * @method     ChildPackageHasArticlesQuery joinWithPackage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Package relation
 *
 * @method     ChildPackageHasArticlesQuery leftJoinWithPackage() Adds a LEFT JOIN clause and with to the query using the Package relation
 * @method     ChildPackageHasArticlesQuery rightJoinWithPackage() Adds a RIGHT JOIN clause and with to the query using the Package relation
 * @method     ChildPackageHasArticlesQuery innerJoinWithPackage() Adds a INNER JOIN clause and with to the query using the Package relation
 *
 * @method     \ArticleQuery|\PackageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPackageHasArticles findOne(ConnectionInterface $con = null) Return the first ChildPackageHasArticles matching the query
 * @method     ChildPackageHasArticles findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPackageHasArticles matching the query, or a new ChildPackageHasArticles object populated from the query conditions when no match is found
 *
 * @method     ChildPackageHasArticles findOneByPackageId(int $package_id) Return the first ChildPackageHasArticles filtered by the package_id column
 * @method     ChildPackageHasArticles findOneByArticleId(int $article_id) Return the first ChildPackageHasArticles filtered by the article_id column *

 * @method     ChildPackageHasArticles requirePk($key, ConnectionInterface $con = null) Return the ChildPackageHasArticles by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackageHasArticles requireOne(ConnectionInterface $con = null) Return the first ChildPackageHasArticles matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPackageHasArticles requireOneByPackageId(int $package_id) Return the first ChildPackageHasArticles filtered by the package_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackageHasArticles requireOneByArticleId(int $article_id) Return the first ChildPackageHasArticles filtered by the article_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPackageHasArticles[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPackageHasArticles objects based on current ModelCriteria
 * @method     ChildPackageHasArticles[]|ObjectCollection findByPackageId(int $package_id) Return ChildPackageHasArticles objects filtered by the package_id column
 * @method     ChildPackageHasArticles[]|ObjectCollection findByArticleId(int $article_id) Return ChildPackageHasArticles objects filtered by the article_id column
 * @method     ChildPackageHasArticles[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PackageHasArticlesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PackageHasArticlesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\PackageHasArticles', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPackageHasArticlesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPackageHasArticlesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPackageHasArticlesQuery) {
            return $criteria;
        }
        $query = new ChildPackageHasArticlesQuery();
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
     * @param array[$package_id, $article_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPackageHasArticles|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PackageHasArticlesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PackageHasArticlesTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildPackageHasArticles A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT package_id, article_id FROM package_has_articles WHERE package_id = :p0 AND article_id = :p1';
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
            /** @var ChildPackageHasArticles $obj */
            $obj = new ChildPackageHasArticles();
            $obj->hydrate($row);
            PackageHasArticlesTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildPackageHasArticles|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPackageHasArticlesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PackageHasArticlesTableMap::COL_PACKAGE_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PackageHasArticlesTableMap::COL_ARTICLE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPackageHasArticlesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PackageHasArticlesTableMap::COL_PACKAGE_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PackageHasArticlesTableMap::COL_ARTICLE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByPackage()
     *
     * @param     mixed $packageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackageHasArticlesQuery The current query, for fluid interface
     */
    public function filterByPackageId($packageId = null, $comparison = null)
    {
        if (is_array($packageId)) {
            $useMinMax = false;
            if (isset($packageId['min'])) {
                $this->addUsingAlias(PackageHasArticlesTableMap::COL_PACKAGE_ID, $packageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($packageId['max'])) {
                $this->addUsingAlias(PackageHasArticlesTableMap::COL_PACKAGE_ID, $packageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackageHasArticlesTableMap::COL_PACKAGE_ID, $packageId, $comparison);
    }

    /**
     * Filter the query on the article_id column
     *
     * Example usage:
     * <code>
     * $query->filterByArticleId(1234); // WHERE article_id = 1234
     * $query->filterByArticleId(array(12, 34)); // WHERE article_id IN (12, 34)
     * $query->filterByArticleId(array('min' => 12)); // WHERE article_id > 12
     * </code>
     *
     * @see       filterByArticle()
     *
     * @param     mixed $articleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackageHasArticlesQuery The current query, for fluid interface
     */
    public function filterByArticleId($articleId = null, $comparison = null)
    {
        if (is_array($articleId)) {
            $useMinMax = false;
            if (isset($articleId['min'])) {
                $this->addUsingAlias(PackageHasArticlesTableMap::COL_ARTICLE_ID, $articleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($articleId['max'])) {
                $this->addUsingAlias(PackageHasArticlesTableMap::COL_ARTICLE_ID, $articleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackageHasArticlesTableMap::COL_ARTICLE_ID, $articleId, $comparison);
    }

    /**
     * Filter the query by a related \Article object
     *
     * @param \Article|ObjectCollection $article The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPackageHasArticlesQuery The current query, for fluid interface
     */
    public function filterByArticle($article, $comparison = null)
    {
        if ($article instanceof \Article) {
            return $this
                ->addUsingAlias(PackageHasArticlesTableMap::COL_ARTICLE_ID, $article->getArticleId(), $comparison);
        } elseif ($article instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PackageHasArticlesTableMap::COL_ARTICLE_ID, $article->toKeyValue('PrimaryKey', 'ArticleId'), $comparison);
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
     * @return $this|ChildPackageHasArticlesQuery The current query, for fluid interface
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
     * Filter the query by a related \Package object
     *
     * @param \Package|ObjectCollection $package The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPackageHasArticlesQuery The current query, for fluid interface
     */
    public function filterByPackage($package, $comparison = null)
    {
        if ($package instanceof \Package) {
            return $this
                ->addUsingAlias(PackageHasArticlesTableMap::COL_PACKAGE_ID, $package->getPackageId(), $comparison);
        } elseif ($package instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PackageHasArticlesTableMap::COL_PACKAGE_ID, $package->toKeyValue('PrimaryKey', 'PackageId'), $comparison);
        } else {
            throw new PropelException('filterByPackage() only accepts arguments of type \Package or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Package relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPackageHasArticlesQuery The current query, for fluid interface
     */
    public function joinPackage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Package');

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
            $this->addJoinObject($join, 'Package');
        }

        return $this;
    }

    /**
     * Use the Package relation Package object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PackageQuery A secondary query class using the current class as primary query
     */
    public function usePackageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPackage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Package', '\PackageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPackageHasArticles $packageHasArticles Object to remove from the list of results
     *
     * @return $this|ChildPackageHasArticlesQuery The current query, for fluid interface
     */
    public function prune($packageHasArticles = null)
    {
        if ($packageHasArticles) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PackageHasArticlesTableMap::COL_PACKAGE_ID), $packageHasArticles->getPackageId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PackageHasArticlesTableMap::COL_ARTICLE_ID), $packageHasArticles->getArticleId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the package_has_articles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PackageHasArticlesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PackageHasArticlesTableMap::clearInstancePool();
            PackageHasArticlesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PackageHasArticlesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PackageHasArticlesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PackageHasArticlesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PackageHasArticlesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PackageHasArticlesQuery
