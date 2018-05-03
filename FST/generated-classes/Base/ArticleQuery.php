<?php

namespace Base;

use \Article as ChildArticle;
use \ArticleQuery as ChildArticleQuery;
use \Exception;
use \PDO;
use Map\ArticleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'article' table.
 *
 *
 *
 * @method     ChildArticleQuery orderByArticleId($order = Criteria::ASC) Order by the article_id column
 * @method     ChildArticleQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildArticleQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildArticleQuery orderByCreation($order = Criteria::ASC) Order by the creation column
 * @method     ChildArticleQuery orderByVisible($order = Criteria::ASC) Order by the visible column
 * @method     ChildArticleQuery orderByShapeId($order = Criteria::ASC) Order by the shape_id column
 * @method     ChildArticleQuery orderByCakeTypeId($order = Criteria::ASC) Order by the cake_type_id column
 *
 * @method     ChildArticleQuery groupByArticleId() Group by the article_id column
 * @method     ChildArticleQuery groupByDescription() Group by the description column
 * @method     ChildArticleQuery groupByPrice() Group by the price column
 * @method     ChildArticleQuery groupByCreation() Group by the creation column
 * @method     ChildArticleQuery groupByVisible() Group by the visible column
 * @method     ChildArticleQuery groupByShapeId() Group by the shape_id column
 * @method     ChildArticleQuery groupByCakeTypeId() Group by the cake_type_id column
 *
 * @method     ChildArticleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildArticleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildArticleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildArticleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildArticleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildArticleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildArticleQuery leftJoinCakeType($relationAlias = null) Adds a LEFT JOIN clause to the query using the CakeType relation
 * @method     ChildArticleQuery rightJoinCakeType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CakeType relation
 * @method     ChildArticleQuery innerJoinCakeType($relationAlias = null) Adds a INNER JOIN clause to the query using the CakeType relation
 *
 * @method     ChildArticleQuery joinWithCakeType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CakeType relation
 *
 * @method     ChildArticleQuery leftJoinWithCakeType() Adds a LEFT JOIN clause and with to the query using the CakeType relation
 * @method     ChildArticleQuery rightJoinWithCakeType() Adds a RIGHT JOIN clause and with to the query using the CakeType relation
 * @method     ChildArticleQuery innerJoinWithCakeType() Adds a INNER JOIN clause and with to the query using the CakeType relation
 *
 * @method     ChildArticleQuery leftJoinShape($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shape relation
 * @method     ChildArticleQuery rightJoinShape($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shape relation
 * @method     ChildArticleQuery innerJoinShape($relationAlias = null) Adds a INNER JOIN clause to the query using the Shape relation
 *
 * @method     ChildArticleQuery joinWithShape($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shape relation
 *
 * @method     ChildArticleQuery leftJoinWithShape() Adds a LEFT JOIN clause and with to the query using the Shape relation
 * @method     ChildArticleQuery rightJoinWithShape() Adds a RIGHT JOIN clause and with to the query using the Shape relation
 * @method     ChildArticleQuery innerJoinWithShape() Adds a INNER JOIN clause and with to the query using the Shape relation
 *
 * @method     ChildArticleQuery leftJoinArticleHasIngredient($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArticleHasIngredient relation
 * @method     ChildArticleQuery rightJoinArticleHasIngredient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArticleHasIngredient relation
 * @method     ChildArticleQuery innerJoinArticleHasIngredient($relationAlias = null) Adds a INNER JOIN clause to the query using the ArticleHasIngredient relation
 *
 * @method     ChildArticleQuery joinWithArticleHasIngredient($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ArticleHasIngredient relation
 *
 * @method     ChildArticleQuery leftJoinWithArticleHasIngredient() Adds a LEFT JOIN clause and with to the query using the ArticleHasIngredient relation
 * @method     ChildArticleQuery rightJoinWithArticleHasIngredient() Adds a RIGHT JOIN clause and with to the query using the ArticleHasIngredient relation
 * @method     ChildArticleQuery innerJoinWithArticleHasIngredient() Adds a INNER JOIN clause and with to the query using the ArticleHasIngredient relation
 *
 * @method     ChildArticleQuery leftJoinOrderHasArticles($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderHasArticles relation
 * @method     ChildArticleQuery rightJoinOrderHasArticles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderHasArticles relation
 * @method     ChildArticleQuery innerJoinOrderHasArticles($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderHasArticles relation
 *
 * @method     ChildArticleQuery joinWithOrderHasArticles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderHasArticles relation
 *
 * @method     ChildArticleQuery leftJoinWithOrderHasArticles() Adds a LEFT JOIN clause and with to the query using the OrderHasArticles relation
 * @method     ChildArticleQuery rightJoinWithOrderHasArticles() Adds a RIGHT JOIN clause and with to the query using the OrderHasArticles relation
 * @method     ChildArticleQuery innerJoinWithOrderHasArticles() Adds a INNER JOIN clause and with to the query using the OrderHasArticles relation
 *
 * @method     ChildArticleQuery leftJoinPackageHasArticles($relationAlias = null) Adds a LEFT JOIN clause to the query using the PackageHasArticles relation
 * @method     ChildArticleQuery rightJoinPackageHasArticles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PackageHasArticles relation
 * @method     ChildArticleQuery innerJoinPackageHasArticles($relationAlias = null) Adds a INNER JOIN clause to the query using the PackageHasArticles relation
 *
 * @method     ChildArticleQuery joinWithPackageHasArticles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PackageHasArticles relation
 *
 * @method     ChildArticleQuery leftJoinWithPackageHasArticles() Adds a LEFT JOIN clause and with to the query using the PackageHasArticles relation
 * @method     ChildArticleQuery rightJoinWithPackageHasArticles() Adds a RIGHT JOIN clause and with to the query using the PackageHasArticles relation
 * @method     ChildArticleQuery innerJoinWithPackageHasArticles() Adds a INNER JOIN clause and with to the query using the PackageHasArticles relation
 *
 * @method     ChildArticleQuery leftJoinRating($relationAlias = null) Adds a LEFT JOIN clause to the query using the Rating relation
 * @method     ChildArticleQuery rightJoinRating($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Rating relation
 * @method     ChildArticleQuery innerJoinRating($relationAlias = null) Adds a INNER JOIN clause to the query using the Rating relation
 *
 * @method     ChildArticleQuery joinWithRating($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Rating relation
 *
 * @method     ChildArticleQuery leftJoinWithRating() Adds a LEFT JOIN clause and with to the query using the Rating relation
 * @method     ChildArticleQuery rightJoinWithRating() Adds a RIGHT JOIN clause and with to the query using the Rating relation
 * @method     ChildArticleQuery innerJoinWithRating() Adds a INNER JOIN clause and with to the query using the Rating relation
 *
 * @method     \CakeTypeQuery|\ShapeQuery|\ArticleHasIngredientQuery|\OrderHasArticlesQuery|\PackageHasArticlesQuery|\RatingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildArticle findOne(ConnectionInterface $con = null) Return the first ChildArticle matching the query
 * @method     ChildArticle findOneOrCreate(ConnectionInterface $con = null) Return the first ChildArticle matching the query, or a new ChildArticle object populated from the query conditions when no match is found
 *
 * @method     ChildArticle findOneByArticleId(int $article_id) Return the first ChildArticle filtered by the article_id column
 * @method     ChildArticle findOneByDescription(string $description) Return the first ChildArticle filtered by the description column
 * @method     ChildArticle findOneByPrice(double $price) Return the first ChildArticle filtered by the price column
 * @method     ChildArticle findOneByCreation(string $creation) Return the first ChildArticle filtered by the creation column
 * @method     ChildArticle findOneByVisible(string $visible) Return the first ChildArticle filtered by the visible column
 * @method     ChildArticle findOneByShapeId(int $shape_id) Return the first ChildArticle filtered by the shape_id column
 * @method     ChildArticle findOneByCakeTypeId(int $cake_type_id) Return the first ChildArticle filtered by the cake_type_id column *

 * @method     ChildArticle requirePk($key, ConnectionInterface $con = null) Return the ChildArticle by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOne(ConnectionInterface $con = null) Return the first ChildArticle matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildArticle requireOneByArticleId(int $article_id) Return the first ChildArticle filtered by the article_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByDescription(string $description) Return the first ChildArticle filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByPrice(double $price) Return the first ChildArticle filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByCreation(string $creation) Return the first ChildArticle filtered by the creation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByVisible(string $visible) Return the first ChildArticle filtered by the visible column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByShapeId(int $shape_id) Return the first ChildArticle filtered by the shape_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByCakeTypeId(int $cake_type_id) Return the first ChildArticle filtered by the cake_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildArticle[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildArticle objects based on current ModelCriteria
 * @method     ChildArticle[]|ObjectCollection findByArticleId(int $article_id) Return ChildArticle objects filtered by the article_id column
 * @method     ChildArticle[]|ObjectCollection findByDescription(string $description) Return ChildArticle objects filtered by the description column
 * @method     ChildArticle[]|ObjectCollection findByPrice(double $price) Return ChildArticle objects filtered by the price column
 * @method     ChildArticle[]|ObjectCollection findByCreation(string $creation) Return ChildArticle objects filtered by the creation column
 * @method     ChildArticle[]|ObjectCollection findByVisible(string $visible) Return ChildArticle objects filtered by the visible column
 * @method     ChildArticle[]|ObjectCollection findByShapeId(int $shape_id) Return ChildArticle objects filtered by the shape_id column
 * @method     ChildArticle[]|ObjectCollection findByCakeTypeId(int $cake_type_id) Return ChildArticle objects filtered by the cake_type_id column
 * @method     ChildArticle[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ArticleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ArticleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'FST4', $modelName = '\\Article', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildArticleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildArticleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildArticleQuery) {
            return $criteria;
        }
        $query = new ChildArticleQuery();
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
     * @return ChildArticle|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ArticleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ArticleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildArticle A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT article_id, description, price, creation, visible, shape_id, cake_type_id FROM article WHERE article_id = :p0';
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
            /** @var ChildArticle $obj */
            $obj = new ChildArticle();
            $obj->hydrate($row);
            ArticleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildArticle|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ArticleTableMap::COL_ARTICLE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ArticleTableMap::COL_ARTICLE_ID, $keys, Criteria::IN);
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
     * @param     mixed $articleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByArticleId($articleId = null, $comparison = null)
    {
        if (is_array($articleId)) {
            $useMinMax = false;
            if (isset($articleId['min'])) {
                $this->addUsingAlias(ArticleTableMap::COL_ARTICLE_ID, $articleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($articleId['max'])) {
                $this->addUsingAlias(ArticleTableMap::COL_ARTICLE_ID, $articleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_ARTICLE_ID, $articleId, $comparison);
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
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(ArticleTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(ArticleTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the creation column
     *
     * Example usage:
     * <code>
     * $query->filterByCreation('fooValue');   // WHERE creation = 'fooValue'
     * $query->filterByCreation('%fooValue%', Criteria::LIKE); // WHERE creation LIKE '%fooValue%'
     * </code>
     *
     * @param     string $creation The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByCreation($creation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($creation)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_CREATION, $creation, $comparison);
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
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByVisible($visible = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($visible)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_VISIBLE, $visible, $comparison);
    }

    /**
     * Filter the query on the shape_id column
     *
     * Example usage:
     * <code>
     * $query->filterByShapeId(1234); // WHERE shape_id = 1234
     * $query->filterByShapeId(array(12, 34)); // WHERE shape_id IN (12, 34)
     * $query->filterByShapeId(array('min' => 12)); // WHERE shape_id > 12
     * </code>
     *
     * @see       filterByShape()
     *
     * @param     mixed $shapeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByShapeId($shapeId = null, $comparison = null)
    {
        if (is_array($shapeId)) {
            $useMinMax = false;
            if (isset($shapeId['min'])) {
                $this->addUsingAlias(ArticleTableMap::COL_SHAPE_ID, $shapeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shapeId['max'])) {
                $this->addUsingAlias(ArticleTableMap::COL_SHAPE_ID, $shapeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_SHAPE_ID, $shapeId, $comparison);
    }

    /**
     * Filter the query on the cake_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCakeTypeId(1234); // WHERE cake_type_id = 1234
     * $query->filterByCakeTypeId(array(12, 34)); // WHERE cake_type_id IN (12, 34)
     * $query->filterByCakeTypeId(array('min' => 12)); // WHERE cake_type_id > 12
     * </code>
     *
     * @see       filterByCakeType()
     *
     * @param     mixed $cakeTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByCakeTypeId($cakeTypeId = null, $comparison = null)
    {
        if (is_array($cakeTypeId)) {
            $useMinMax = false;
            if (isset($cakeTypeId['min'])) {
                $this->addUsingAlias(ArticleTableMap::COL_CAKE_TYPE_ID, $cakeTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cakeTypeId['max'])) {
                $this->addUsingAlias(ArticleTableMap::COL_CAKE_TYPE_ID, $cakeTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_CAKE_TYPE_ID, $cakeTypeId, $comparison);
    }

    /**
     * Filter the query by a related \CakeType object
     *
     * @param \CakeType|ObjectCollection $cakeType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildArticleQuery The current query, for fluid interface
     */
    public function filterByCakeType($cakeType, $comparison = null)
    {
        if ($cakeType instanceof \CakeType) {
            return $this
                ->addUsingAlias(ArticleTableMap::COL_CAKE_TYPE_ID, $cakeType->getCakeTypeId(), $comparison);
        } elseif ($cakeType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ArticleTableMap::COL_CAKE_TYPE_ID, $cakeType->toKeyValue('PrimaryKey', 'CakeTypeId'), $comparison);
        } else {
            throw new PropelException('filterByCakeType() only accepts arguments of type \CakeType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CakeType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function joinCakeType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CakeType');

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
            $this->addJoinObject($join, 'CakeType');
        }

        return $this;
    }

    /**
     * Use the CakeType relation CakeType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CakeTypeQuery A secondary query class using the current class as primary query
     */
    public function useCakeTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCakeType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CakeType', '\CakeTypeQuery');
    }

    /**
     * Filter the query by a related \Shape object
     *
     * @param \Shape|ObjectCollection $shape The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildArticleQuery The current query, for fluid interface
     */
    public function filterByShape($shape, $comparison = null)
    {
        if ($shape instanceof \Shape) {
            return $this
                ->addUsingAlias(ArticleTableMap::COL_SHAPE_ID, $shape->getShapeId(), $comparison);
        } elseif ($shape instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ArticleTableMap::COL_SHAPE_ID, $shape->toKeyValue('PrimaryKey', 'ShapeId'), $comparison);
        } else {
            throw new PropelException('filterByShape() only accepts arguments of type \Shape or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Shape relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function joinShape($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Shape');

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
            $this->addJoinObject($join, 'Shape');
        }

        return $this;
    }

    /**
     * Use the Shape relation Shape object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ShapeQuery A secondary query class using the current class as primary query
     */
    public function useShapeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShape($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Shape', '\ShapeQuery');
    }

    /**
     * Filter the query by a related \ArticleHasIngredient object
     *
     * @param \ArticleHasIngredient|ObjectCollection $articleHasIngredient the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArticleQuery The current query, for fluid interface
     */
    public function filterByArticleHasIngredient($articleHasIngredient, $comparison = null)
    {
        if ($articleHasIngredient instanceof \ArticleHasIngredient) {
            return $this
                ->addUsingAlias(ArticleTableMap::COL_ARTICLE_ID, $articleHasIngredient->getArticleId(), $comparison);
        } elseif ($articleHasIngredient instanceof ObjectCollection) {
            return $this
                ->useArticleHasIngredientQuery()
                ->filterByPrimaryKeys($articleHasIngredient->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByArticleHasIngredient() only accepts arguments of type \ArticleHasIngredient or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ArticleHasIngredient relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function joinArticleHasIngredient($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ArticleHasIngredient');

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
            $this->addJoinObject($join, 'ArticleHasIngredient');
        }

        return $this;
    }

    /**
     * Use the ArticleHasIngredient relation ArticleHasIngredient object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ArticleHasIngredientQuery A secondary query class using the current class as primary query
     */
    public function useArticleHasIngredientQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinArticleHasIngredient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ArticleHasIngredient', '\ArticleHasIngredientQuery');
    }

    /**
     * Filter the query by a related \OrderHasArticles object
     *
     * @param \OrderHasArticles|ObjectCollection $orderHasArticles the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArticleQuery The current query, for fluid interface
     */
    public function filterByOrderHasArticles($orderHasArticles, $comparison = null)
    {
        if ($orderHasArticles instanceof \OrderHasArticles) {
            return $this
                ->addUsingAlias(ArticleTableMap::COL_ARTICLE_ID, $orderHasArticles->getArticleId(), $comparison);
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
     * @return $this|ChildArticleQuery The current query, for fluid interface
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
     * Filter the query by a related \PackageHasArticles object
     *
     * @param \PackageHasArticles|ObjectCollection $packageHasArticles the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArticleQuery The current query, for fluid interface
     */
    public function filterByPackageHasArticles($packageHasArticles, $comparison = null)
    {
        if ($packageHasArticles instanceof \PackageHasArticles) {
            return $this
                ->addUsingAlias(ArticleTableMap::COL_ARTICLE_ID, $packageHasArticles->getArticleId(), $comparison);
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
     * @return $this|ChildArticleQuery The current query, for fluid interface
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
     * Filter the query by a related \Rating object
     *
     * @param \Rating|ObjectCollection $rating the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArticleQuery The current query, for fluid interface
     */
    public function filterByRating($rating, $comparison = null)
    {
        if ($rating instanceof \Rating) {
            return $this
                ->addUsingAlias(ArticleTableMap::COL_ARTICLE_ID, $rating->getArticleId(), $comparison);
        } elseif ($rating instanceof ObjectCollection) {
            return $this
                ->useRatingQuery()
                ->filterByPrimaryKeys($rating->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRating() only accepts arguments of type \Rating or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Rating relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function joinRating($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Rating');

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
            $this->addJoinObject($join, 'Rating');
        }

        return $this;
    }

    /**
     * Use the Rating relation Rating object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingQuery A secondary query class using the current class as primary query
     */
    public function useRatingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRating($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Rating', '\RatingQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildArticle $article Object to remove from the list of results
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function prune($article = null)
    {
        if ($article) {
            $this->addUsingAlias(ArticleTableMap::COL_ARTICLE_ID, $article->getArticleId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the article table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArticleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ArticleTableMap::clearInstancePool();
            ArticleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ArticleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ArticleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ArticleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ArticleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ArticleQuery
