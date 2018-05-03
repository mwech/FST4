<?php

namespace Base;

use \Article as ChildArticle;
use \ArticleHasIngredient as ChildArticleHasIngredient;
use \ArticleHasIngredientQuery as ChildArticleHasIngredientQuery;
use \ArticleQuery as ChildArticleQuery;
use \CakeType as ChildCakeType;
use \CakeTypeQuery as ChildCakeTypeQuery;
use \OrderHasArticles as ChildOrderHasArticles;
use \OrderHasArticlesQuery as ChildOrderHasArticlesQuery;
use \PackageHasArticles as ChildPackageHasArticles;
use \PackageHasArticlesQuery as ChildPackageHasArticlesQuery;
use \Rating as ChildRating;
use \RatingQuery as ChildRatingQuery;
use \Shape as ChildShape;
use \ShapeQuery as ChildShapeQuery;
use \Exception;
use \PDO;
use Map\ArticleHasIngredientTableMap;
use Map\ArticleTableMap;
use Map\OrderHasArticlesTableMap;
use Map\PackageHasArticlesTableMap;
use Map\RatingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'article' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Article implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ArticleTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the article_id field.
     *
     * @var        int
     */
    protected $article_id;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the price field.
     *
     * @var        double
     */
    protected $price;

    /**
     * The value for the creation field.
     *
     * @var        string
     */
    protected $creation;

    /**
     * The value for the visible field.
     *
     * @var        string
     */
    protected $visible;

    /**
     * The value for the shape_id field.
     *
     * @var        int
     */
    protected $shape_id;

    /**
     * The value for the cake_type_id field.
     *
     * @var        int
     */
    protected $cake_type_id;

    /**
     * @var        ChildCakeType
     */
    protected $aCakeType;

    /**
     * @var        ChildShape
     */
    protected $aShape;

    /**
     * @var        ObjectCollection|ChildArticleHasIngredient[] Collection to store aggregation of ChildArticleHasIngredient objects.
     */
    protected $collArticleHasIngredients;
    protected $collArticleHasIngredientsPartial;

    /**
     * @var        ObjectCollection|ChildOrderHasArticles[] Collection to store aggregation of ChildOrderHasArticles objects.
     */
    protected $collOrderHasArticless;
    protected $collOrderHasArticlessPartial;

    /**
     * @var        ObjectCollection|ChildPackageHasArticles[] Collection to store aggregation of ChildPackageHasArticles objects.
     */
    protected $collPackageHasArticless;
    protected $collPackageHasArticlessPartial;

    /**
     * @var        ObjectCollection|ChildRating[] Collection to store aggregation of ChildRating objects.
     */
    protected $collRatings;
    protected $collRatingsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildArticleHasIngredient[]
     */
    protected $articleHasIngredientsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderHasArticles[]
     */
    protected $orderHasArticlessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPackageHasArticles[]
     */
    protected $packageHasArticlessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRating[]
     */
    protected $ratingsScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Article object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Article</code> instance.  If
     * <code>obj</code> is an instance of <code>Article</code>, delegates to
     * <code>equals(Article)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Article The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [article_id] column value.
     *
     * @return int
     */
    public function getArticleId()
    {
        return $this->article_id;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [price] column value.
     *
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get the [creation] column value.
     *
     * @return string
     */
    public function getCreation()
    {
        return $this->creation;
    }

    /**
     * Get the [visible] column value.
     *
     * @return string
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Get the [shape_id] column value.
     *
     * @return int
     */
    public function getShapeId()
    {
        return $this->shape_id;
    }

    /**
     * Get the [cake_type_id] column value.
     *
     * @return int
     */
    public function getCakeTypeId()
    {
        return $this->cake_type_id;
    }

    /**
     * Set the value of [article_id] column.
     *
     * @param int $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setArticleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->article_id !== $v) {
            $this->article_id = $v;
            $this->modifiedColumns[ArticleTableMap::COL_ARTICLE_ID] = true;
        }

        return $this;
    } // setArticleId()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[ArticleTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [price] column.
     *
     * @param double $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setPrice($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->price !== $v) {
            $this->price = $v;
            $this->modifiedColumns[ArticleTableMap::COL_PRICE] = true;
        }

        return $this;
    } // setPrice()

    /**
     * Set the value of [creation] column.
     *
     * @param string $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setCreation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->creation !== $v) {
            $this->creation = $v;
            $this->modifiedColumns[ArticleTableMap::COL_CREATION] = true;
        }

        return $this;
    } // setCreation()

    /**
     * Set the value of [visible] column.
     *
     * @param string $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setVisible($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->visible !== $v) {
            $this->visible = $v;
            $this->modifiedColumns[ArticleTableMap::COL_VISIBLE] = true;
        }

        return $this;
    } // setVisible()

    /**
     * Set the value of [shape_id] column.
     *
     * @param int $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setShapeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->shape_id !== $v) {
            $this->shape_id = $v;
            $this->modifiedColumns[ArticleTableMap::COL_SHAPE_ID] = true;
        }

        if ($this->aShape !== null && $this->aShape->getShapeId() !== $v) {
            $this->aShape = null;
        }

        return $this;
    } // setShapeId()

    /**
     * Set the value of [cake_type_id] column.
     *
     * @param int $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setCakeTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->cake_type_id !== $v) {
            $this->cake_type_id = $v;
            $this->modifiedColumns[ArticleTableMap::COL_CAKE_TYPE_ID] = true;
        }

        if ($this->aCakeType !== null && $this->aCakeType->getCakeTypeId() !== $v) {
            $this->aCakeType = null;
        }

        return $this;
    } // setCakeTypeId()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ArticleTableMap::translateFieldName('ArticleId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->article_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ArticleTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ArticleTableMap::translateFieldName('Price', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ArticleTableMap::translateFieldName('Creation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->creation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ArticleTableMap::translateFieldName('Visible', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visible = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ArticleTableMap::translateFieldName('ShapeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shape_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ArticleTableMap::translateFieldName('CakeTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cake_type_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = ArticleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Article'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aShape !== null && $this->shape_id !== $this->aShape->getShapeId()) {
            $this->aShape = null;
        }
        if ($this->aCakeType !== null && $this->cake_type_id !== $this->aCakeType->getCakeTypeId()) {
            $this->aCakeType = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ArticleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildArticleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCakeType = null;
            $this->aShape = null;
            $this->collArticleHasIngredients = null;

            $this->collOrderHasArticless = null;

            $this->collPackageHasArticless = null;

            $this->collRatings = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Article::setDeleted()
     * @see Article::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArticleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildArticleQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArticleTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ArticleTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCakeType !== null) {
                if ($this->aCakeType->isModified() || $this->aCakeType->isNew()) {
                    $affectedRows += $this->aCakeType->save($con);
                }
                $this->setCakeType($this->aCakeType);
            }

            if ($this->aShape !== null) {
                if ($this->aShape->isModified() || $this->aShape->isNew()) {
                    $affectedRows += $this->aShape->save($con);
                }
                $this->setShape($this->aShape);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->articleHasIngredientsScheduledForDeletion !== null) {
                if (!$this->articleHasIngredientsScheduledForDeletion->isEmpty()) {
                    \ArticleHasIngredientQuery::create()
                        ->filterByPrimaryKeys($this->articleHasIngredientsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->articleHasIngredientsScheduledForDeletion = null;
                }
            }

            if ($this->collArticleHasIngredients !== null) {
                foreach ($this->collArticleHasIngredients as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderHasArticlessScheduledForDeletion !== null) {
                if (!$this->orderHasArticlessScheduledForDeletion->isEmpty()) {
                    \OrderHasArticlesQuery::create()
                        ->filterByPrimaryKeys($this->orderHasArticlessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderHasArticlessScheduledForDeletion = null;
                }
            }

            if ($this->collOrderHasArticless !== null) {
                foreach ($this->collOrderHasArticless as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->packageHasArticlessScheduledForDeletion !== null) {
                if (!$this->packageHasArticlessScheduledForDeletion->isEmpty()) {
                    \PackageHasArticlesQuery::create()
                        ->filterByPrimaryKeys($this->packageHasArticlessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->packageHasArticlessScheduledForDeletion = null;
                }
            }

            if ($this->collPackageHasArticless !== null) {
                foreach ($this->collPackageHasArticless as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ratingsScheduledForDeletion !== null) {
                if (!$this->ratingsScheduledForDeletion->isEmpty()) {
                    \RatingQuery::create()
                        ->filterByPrimaryKeys($this->ratingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ratingsScheduledForDeletion = null;
                }
            }

            if ($this->collRatings !== null) {
                foreach ($this->collRatings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ArticleTableMap::COL_ARTICLE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'article_id';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'price';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_CREATION)) {
            $modifiedColumns[':p' . $index++]  = 'creation';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_VISIBLE)) {
            $modifiedColumns[':p' . $index++]  = 'visible';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_SHAPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'shape_id';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_CAKE_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'cake_type_id';
        }

        $sql = sprintf(
            'INSERT INTO article (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'article_id':
                        $stmt->bindValue($identifier, $this->article_id, PDO::PARAM_INT);
                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'price':
                        $stmt->bindValue($identifier, $this->price, PDO::PARAM_STR);
                        break;
                    case 'creation':
                        $stmt->bindValue($identifier, $this->creation, PDO::PARAM_STR);
                        break;
                    case 'visible':
                        $stmt->bindValue($identifier, $this->visible, PDO::PARAM_STR);
                        break;
                    case 'shape_id':
                        $stmt->bindValue($identifier, $this->shape_id, PDO::PARAM_INT);
                        break;
                    case 'cake_type_id':
                        $stmt->bindValue($identifier, $this->cake_type_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ArticleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getArticleId();
                break;
            case 1:
                return $this->getDescription();
                break;
            case 2:
                return $this->getPrice();
                break;
            case 3:
                return $this->getCreation();
                break;
            case 4:
                return $this->getVisible();
                break;
            case 5:
                return $this->getShapeId();
                break;
            case 6:
                return $this->getCakeTypeId();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Article'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Article'][$this->hashCode()] = true;
        $keys = ArticleTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getArticleId(),
            $keys[1] => $this->getDescription(),
            $keys[2] => $this->getPrice(),
            $keys[3] => $this->getCreation(),
            $keys[4] => $this->getVisible(),
            $keys[5] => $this->getShapeId(),
            $keys[6] => $this->getCakeTypeId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCakeType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'cakeType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'cake_type';
                        break;
                    default:
                        $key = 'CakeType';
                }

                $result[$key] = $this->aCakeType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aShape) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'shape';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'shape';
                        break;
                    default:
                        $key = 'Shape';
                }

                $result[$key] = $this->aShape->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collArticleHasIngredients) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'articleHasIngredients';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'article_has_ingredients';
                        break;
                    default:
                        $key = 'ArticleHasIngredients';
                }

                $result[$key] = $this->collArticleHasIngredients->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderHasArticless) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderHasArticless';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'order_has_articless';
                        break;
                    default:
                        $key = 'OrderHasArticless';
                }

                $result[$key] = $this->collOrderHasArticless->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPackageHasArticless) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'packageHasArticless';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'package_has_articless';
                        break;
                    default:
                        $key = 'PackageHasArticless';
                }

                $result[$key] = $this->collPackageHasArticless->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRatings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ratings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ratings';
                        break;
                    default:
                        $key = 'Ratings';
                }

                $result[$key] = $this->collRatings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Article
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ArticleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Article
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setArticleId($value);
                break;
            case 1:
                $this->setDescription($value);
                break;
            case 2:
                $this->setPrice($value);
                break;
            case 3:
                $this->setCreation($value);
                break;
            case 4:
                $this->setVisible($value);
                break;
            case 5:
                $this->setShapeId($value);
                break;
            case 6:
                $this->setCakeTypeId($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ArticleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setArticleId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setDescription($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPrice($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCreation($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setVisible($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setShapeId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCakeTypeId($arr[$keys[6]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Article The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ArticleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ArticleTableMap::COL_ARTICLE_ID)) {
            $criteria->add(ArticleTableMap::COL_ARTICLE_ID, $this->article_id);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_DESCRIPTION)) {
            $criteria->add(ArticleTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_PRICE)) {
            $criteria->add(ArticleTableMap::COL_PRICE, $this->price);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_CREATION)) {
            $criteria->add(ArticleTableMap::COL_CREATION, $this->creation);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_VISIBLE)) {
            $criteria->add(ArticleTableMap::COL_VISIBLE, $this->visible);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_SHAPE_ID)) {
            $criteria->add(ArticleTableMap::COL_SHAPE_ID, $this->shape_id);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_CAKE_TYPE_ID)) {
            $criteria->add(ArticleTableMap::COL_CAKE_TYPE_ID, $this->cake_type_id);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildArticleQuery::create();
        $criteria->add(ArticleTableMap::COL_ARTICLE_ID, $this->article_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getArticleId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getArticleId();
    }

    /**
     * Generic method to set the primary key (article_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setArticleId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getArticleId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Article (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setArticleId($this->getArticleId());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setPrice($this->getPrice());
        $copyObj->setCreation($this->getCreation());
        $copyObj->setVisible($this->getVisible());
        $copyObj->setShapeId($this->getShapeId());
        $copyObj->setCakeTypeId($this->getCakeTypeId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getArticleHasIngredients() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addArticleHasIngredient($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderHasArticless() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderHasArticles($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPackageHasArticless() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPackageHasArticles($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRatings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRating($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Article Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildCakeType object.
     *
     * @param  ChildCakeType $v
     * @return $this|\Article The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCakeType(ChildCakeType $v = null)
    {
        if ($v === null) {
            $this->setCakeTypeId(NULL);
        } else {
            $this->setCakeTypeId($v->getCakeTypeId());
        }

        $this->aCakeType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCakeType object, it will not be re-added.
        if ($v !== null) {
            $v->addArticle($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCakeType object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCakeType The associated ChildCakeType object.
     * @throws PropelException
     */
    public function getCakeType(ConnectionInterface $con = null)
    {
        if ($this->aCakeType === null && ($this->cake_type_id != 0)) {
            $this->aCakeType = ChildCakeTypeQuery::create()->findPk($this->cake_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCakeType->addArticles($this);
             */
        }

        return $this->aCakeType;
    }

    /**
     * Declares an association between this object and a ChildShape object.
     *
     * @param  ChildShape $v
     * @return $this|\Article The current object (for fluent API support)
     * @throws PropelException
     */
    public function setShape(ChildShape $v = null)
    {
        if ($v === null) {
            $this->setShapeId(NULL);
        } else {
            $this->setShapeId($v->getShapeId());
        }

        $this->aShape = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildShape object, it will not be re-added.
        if ($v !== null) {
            $v->addArticle($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildShape object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildShape The associated ChildShape object.
     * @throws PropelException
     */
    public function getShape(ConnectionInterface $con = null)
    {
        if ($this->aShape === null && ($this->shape_id != 0)) {
            $this->aShape = ChildShapeQuery::create()->findPk($this->shape_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aShape->addArticles($this);
             */
        }

        return $this->aShape;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ArticleHasIngredient' == $relationName) {
            $this->initArticleHasIngredients();
            return;
        }
        if ('OrderHasArticles' == $relationName) {
            $this->initOrderHasArticless();
            return;
        }
        if ('PackageHasArticles' == $relationName) {
            $this->initPackageHasArticless();
            return;
        }
        if ('Rating' == $relationName) {
            $this->initRatings();
            return;
        }
    }

    /**
     * Clears out the collArticleHasIngredients collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addArticleHasIngredients()
     */
    public function clearArticleHasIngredients()
    {
        $this->collArticleHasIngredients = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collArticleHasIngredients collection loaded partially.
     */
    public function resetPartialArticleHasIngredients($v = true)
    {
        $this->collArticleHasIngredientsPartial = $v;
    }

    /**
     * Initializes the collArticleHasIngredients collection.
     *
     * By default this just sets the collArticleHasIngredients collection to an empty array (like clearcollArticleHasIngredients());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initArticleHasIngredients($overrideExisting = true)
    {
        if (null !== $this->collArticleHasIngredients && !$overrideExisting) {
            return;
        }

        $collectionClassName = ArticleHasIngredientTableMap::getTableMap()->getCollectionClassName();

        $this->collArticleHasIngredients = new $collectionClassName;
        $this->collArticleHasIngredients->setModel('\ArticleHasIngredient');
    }

    /**
     * Gets an array of ChildArticleHasIngredient objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildArticle is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildArticleHasIngredient[] List of ChildArticleHasIngredient objects
     * @throws PropelException
     */
    public function getArticleHasIngredients(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collArticleHasIngredientsPartial && !$this->isNew();
        if (null === $this->collArticleHasIngredients || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collArticleHasIngredients) {
                // return empty collection
                $this->initArticleHasIngredients();
            } else {
                $collArticleHasIngredients = ChildArticleHasIngredientQuery::create(null, $criteria)
                    ->filterByArticle($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collArticleHasIngredientsPartial && count($collArticleHasIngredients)) {
                        $this->initArticleHasIngredients(false);

                        foreach ($collArticleHasIngredients as $obj) {
                            if (false == $this->collArticleHasIngredients->contains($obj)) {
                                $this->collArticleHasIngredients->append($obj);
                            }
                        }

                        $this->collArticleHasIngredientsPartial = true;
                    }

                    return $collArticleHasIngredients;
                }

                if ($partial && $this->collArticleHasIngredients) {
                    foreach ($this->collArticleHasIngredients as $obj) {
                        if ($obj->isNew()) {
                            $collArticleHasIngredients[] = $obj;
                        }
                    }
                }

                $this->collArticleHasIngredients = $collArticleHasIngredients;
                $this->collArticleHasIngredientsPartial = false;
            }
        }

        return $this->collArticleHasIngredients;
    }

    /**
     * Sets a collection of ChildArticleHasIngredient objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $articleHasIngredients A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildArticle The current object (for fluent API support)
     */
    public function setArticleHasIngredients(Collection $articleHasIngredients, ConnectionInterface $con = null)
    {
        /** @var ChildArticleHasIngredient[] $articleHasIngredientsToDelete */
        $articleHasIngredientsToDelete = $this->getArticleHasIngredients(new Criteria(), $con)->diff($articleHasIngredients);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->articleHasIngredientsScheduledForDeletion = clone $articleHasIngredientsToDelete;

        foreach ($articleHasIngredientsToDelete as $articleHasIngredientRemoved) {
            $articleHasIngredientRemoved->setArticle(null);
        }

        $this->collArticleHasIngredients = null;
        foreach ($articleHasIngredients as $articleHasIngredient) {
            $this->addArticleHasIngredient($articleHasIngredient);
        }

        $this->collArticleHasIngredients = $articleHasIngredients;
        $this->collArticleHasIngredientsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ArticleHasIngredient objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ArticleHasIngredient objects.
     * @throws PropelException
     */
    public function countArticleHasIngredients(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collArticleHasIngredientsPartial && !$this->isNew();
        if (null === $this->collArticleHasIngredients || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collArticleHasIngredients) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getArticleHasIngredients());
            }

            $query = ChildArticleHasIngredientQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByArticle($this)
                ->count($con);
        }

        return count($this->collArticleHasIngredients);
    }

    /**
     * Method called to associate a ChildArticleHasIngredient object to this object
     * through the ChildArticleHasIngredient foreign key attribute.
     *
     * @param  ChildArticleHasIngredient $l ChildArticleHasIngredient
     * @return $this|\Article The current object (for fluent API support)
     */
    public function addArticleHasIngredient(ChildArticleHasIngredient $l)
    {
        if ($this->collArticleHasIngredients === null) {
            $this->initArticleHasIngredients();
            $this->collArticleHasIngredientsPartial = true;
        }

        if (!$this->collArticleHasIngredients->contains($l)) {
            $this->doAddArticleHasIngredient($l);

            if ($this->articleHasIngredientsScheduledForDeletion and $this->articleHasIngredientsScheduledForDeletion->contains($l)) {
                $this->articleHasIngredientsScheduledForDeletion->remove($this->articleHasIngredientsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildArticleHasIngredient $articleHasIngredient The ChildArticleHasIngredient object to add.
     */
    protected function doAddArticleHasIngredient(ChildArticleHasIngredient $articleHasIngredient)
    {
        $this->collArticleHasIngredients[]= $articleHasIngredient;
        $articleHasIngredient->setArticle($this);
    }

    /**
     * @param  ChildArticleHasIngredient $articleHasIngredient The ChildArticleHasIngredient object to remove.
     * @return $this|ChildArticle The current object (for fluent API support)
     */
    public function removeArticleHasIngredient(ChildArticleHasIngredient $articleHasIngredient)
    {
        if ($this->getArticleHasIngredients()->contains($articleHasIngredient)) {
            $pos = $this->collArticleHasIngredients->search($articleHasIngredient);
            $this->collArticleHasIngredients->remove($pos);
            if (null === $this->articleHasIngredientsScheduledForDeletion) {
                $this->articleHasIngredientsScheduledForDeletion = clone $this->collArticleHasIngredients;
                $this->articleHasIngredientsScheduledForDeletion->clear();
            }
            $this->articleHasIngredientsScheduledForDeletion[]= clone $articleHasIngredient;
            $articleHasIngredient->setArticle(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Article is new, it will return
     * an empty collection; or if this Article has previously
     * been saved, it will retrieve related ArticleHasIngredients from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Article.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildArticleHasIngredient[] List of ChildArticleHasIngredient objects
     */
    public function getArticleHasIngredientsJoinIngredient(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildArticleHasIngredientQuery::create(null, $criteria);
        $query->joinWith('Ingredient', $joinBehavior);

        return $this->getArticleHasIngredients($query, $con);
    }

    /**
     * Clears out the collOrderHasArticless collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrderHasArticless()
     */
    public function clearOrderHasArticless()
    {
        $this->collOrderHasArticless = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrderHasArticless collection loaded partially.
     */
    public function resetPartialOrderHasArticless($v = true)
    {
        $this->collOrderHasArticlessPartial = $v;
    }

    /**
     * Initializes the collOrderHasArticless collection.
     *
     * By default this just sets the collOrderHasArticless collection to an empty array (like clearcollOrderHasArticless());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderHasArticless($overrideExisting = true)
    {
        if (null !== $this->collOrderHasArticless && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderHasArticlesTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderHasArticless = new $collectionClassName;
        $this->collOrderHasArticless->setModel('\OrderHasArticles');
    }

    /**
     * Gets an array of ChildOrderHasArticles objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildArticle is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrderHasArticles[] List of ChildOrderHasArticles objects
     * @throws PropelException
     */
    public function getOrderHasArticless(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderHasArticlessPartial && !$this->isNew();
        if (null === $this->collOrderHasArticless || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collOrderHasArticless) {
                // return empty collection
                $this->initOrderHasArticless();
            } else {
                $collOrderHasArticless = ChildOrderHasArticlesQuery::create(null, $criteria)
                    ->filterByArticle($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderHasArticlessPartial && count($collOrderHasArticless)) {
                        $this->initOrderHasArticless(false);

                        foreach ($collOrderHasArticless as $obj) {
                            if (false == $this->collOrderHasArticless->contains($obj)) {
                                $this->collOrderHasArticless->append($obj);
                            }
                        }

                        $this->collOrderHasArticlessPartial = true;
                    }

                    return $collOrderHasArticless;
                }

                if ($partial && $this->collOrderHasArticless) {
                    foreach ($this->collOrderHasArticless as $obj) {
                        if ($obj->isNew()) {
                            $collOrderHasArticless[] = $obj;
                        }
                    }
                }

                $this->collOrderHasArticless = $collOrderHasArticless;
                $this->collOrderHasArticlessPartial = false;
            }
        }

        return $this->collOrderHasArticless;
    }

    /**
     * Sets a collection of ChildOrderHasArticles objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orderHasArticless A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildArticle The current object (for fluent API support)
     */
    public function setOrderHasArticless(Collection $orderHasArticless, ConnectionInterface $con = null)
    {
        /** @var ChildOrderHasArticles[] $orderHasArticlessToDelete */
        $orderHasArticlessToDelete = $this->getOrderHasArticless(new Criteria(), $con)->diff($orderHasArticless);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->orderHasArticlessScheduledForDeletion = clone $orderHasArticlessToDelete;

        foreach ($orderHasArticlessToDelete as $orderHasArticlesRemoved) {
            $orderHasArticlesRemoved->setArticle(null);
        }

        $this->collOrderHasArticless = null;
        foreach ($orderHasArticless as $orderHasArticles) {
            $this->addOrderHasArticles($orderHasArticles);
        }

        $this->collOrderHasArticless = $orderHasArticless;
        $this->collOrderHasArticlessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OrderHasArticles objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related OrderHasArticles objects.
     * @throws PropelException
     */
    public function countOrderHasArticless(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderHasArticlessPartial && !$this->isNew();
        if (null === $this->collOrderHasArticless || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderHasArticless) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderHasArticless());
            }

            $query = ChildOrderHasArticlesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByArticle($this)
                ->count($con);
        }

        return count($this->collOrderHasArticless);
    }

    /**
     * Method called to associate a ChildOrderHasArticles object to this object
     * through the ChildOrderHasArticles foreign key attribute.
     *
     * @param  ChildOrderHasArticles $l ChildOrderHasArticles
     * @return $this|\Article The current object (for fluent API support)
     */
    public function addOrderHasArticles(ChildOrderHasArticles $l)
    {
        if ($this->collOrderHasArticless === null) {
            $this->initOrderHasArticless();
            $this->collOrderHasArticlessPartial = true;
        }

        if (!$this->collOrderHasArticless->contains($l)) {
            $this->doAddOrderHasArticles($l);

            if ($this->orderHasArticlessScheduledForDeletion and $this->orderHasArticlessScheduledForDeletion->contains($l)) {
                $this->orderHasArticlessScheduledForDeletion->remove($this->orderHasArticlessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrderHasArticles $orderHasArticles The ChildOrderHasArticles object to add.
     */
    protected function doAddOrderHasArticles(ChildOrderHasArticles $orderHasArticles)
    {
        $this->collOrderHasArticless[]= $orderHasArticles;
        $orderHasArticles->setArticle($this);
    }

    /**
     * @param  ChildOrderHasArticles $orderHasArticles The ChildOrderHasArticles object to remove.
     * @return $this|ChildArticle The current object (for fluent API support)
     */
    public function removeOrderHasArticles(ChildOrderHasArticles $orderHasArticles)
    {
        if ($this->getOrderHasArticless()->contains($orderHasArticles)) {
            $pos = $this->collOrderHasArticless->search($orderHasArticles);
            $this->collOrderHasArticless->remove($pos);
            if (null === $this->orderHasArticlessScheduledForDeletion) {
                $this->orderHasArticlessScheduledForDeletion = clone $this->collOrderHasArticless;
                $this->orderHasArticlessScheduledForDeletion->clear();
            }
            $this->orderHasArticlessScheduledForDeletion[]= clone $orderHasArticles;
            $orderHasArticles->setArticle(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Article is new, it will return
     * an empty collection; or if this Article has previously
     * been saved, it will retrieve related OrderHasArticless from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Article.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderHasArticles[] List of ChildOrderHasArticles objects
     */
    public function getOrderHasArticlessJoinOrder(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderHasArticlesQuery::create(null, $criteria);
        $query->joinWith('Order', $joinBehavior);

        return $this->getOrderHasArticless($query, $con);
    }

    /**
     * Clears out the collPackageHasArticless collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPackageHasArticless()
     */
    public function clearPackageHasArticless()
    {
        $this->collPackageHasArticless = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPackageHasArticless collection loaded partially.
     */
    public function resetPartialPackageHasArticless($v = true)
    {
        $this->collPackageHasArticlessPartial = $v;
    }

    /**
     * Initializes the collPackageHasArticless collection.
     *
     * By default this just sets the collPackageHasArticless collection to an empty array (like clearcollPackageHasArticless());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPackageHasArticless($overrideExisting = true)
    {
        if (null !== $this->collPackageHasArticless && !$overrideExisting) {
            return;
        }

        $collectionClassName = PackageHasArticlesTableMap::getTableMap()->getCollectionClassName();

        $this->collPackageHasArticless = new $collectionClassName;
        $this->collPackageHasArticless->setModel('\PackageHasArticles');
    }

    /**
     * Gets an array of ChildPackageHasArticles objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildArticle is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPackageHasArticles[] List of ChildPackageHasArticles objects
     * @throws PropelException
     */
    public function getPackageHasArticless(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPackageHasArticlessPartial && !$this->isNew();
        if (null === $this->collPackageHasArticless || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPackageHasArticless) {
                // return empty collection
                $this->initPackageHasArticless();
            } else {
                $collPackageHasArticless = ChildPackageHasArticlesQuery::create(null, $criteria)
                    ->filterByArticle($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPackageHasArticlessPartial && count($collPackageHasArticless)) {
                        $this->initPackageHasArticless(false);

                        foreach ($collPackageHasArticless as $obj) {
                            if (false == $this->collPackageHasArticless->contains($obj)) {
                                $this->collPackageHasArticless->append($obj);
                            }
                        }

                        $this->collPackageHasArticlessPartial = true;
                    }

                    return $collPackageHasArticless;
                }

                if ($partial && $this->collPackageHasArticless) {
                    foreach ($this->collPackageHasArticless as $obj) {
                        if ($obj->isNew()) {
                            $collPackageHasArticless[] = $obj;
                        }
                    }
                }

                $this->collPackageHasArticless = $collPackageHasArticless;
                $this->collPackageHasArticlessPartial = false;
            }
        }

        return $this->collPackageHasArticless;
    }

    /**
     * Sets a collection of ChildPackageHasArticles objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $packageHasArticless A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildArticle The current object (for fluent API support)
     */
    public function setPackageHasArticless(Collection $packageHasArticless, ConnectionInterface $con = null)
    {
        /** @var ChildPackageHasArticles[] $packageHasArticlessToDelete */
        $packageHasArticlessToDelete = $this->getPackageHasArticless(new Criteria(), $con)->diff($packageHasArticless);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->packageHasArticlessScheduledForDeletion = clone $packageHasArticlessToDelete;

        foreach ($packageHasArticlessToDelete as $packageHasArticlesRemoved) {
            $packageHasArticlesRemoved->setArticle(null);
        }

        $this->collPackageHasArticless = null;
        foreach ($packageHasArticless as $packageHasArticles) {
            $this->addPackageHasArticles($packageHasArticles);
        }

        $this->collPackageHasArticless = $packageHasArticless;
        $this->collPackageHasArticlessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PackageHasArticles objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PackageHasArticles objects.
     * @throws PropelException
     */
    public function countPackageHasArticless(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPackageHasArticlessPartial && !$this->isNew();
        if (null === $this->collPackageHasArticless || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPackageHasArticless) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPackageHasArticless());
            }

            $query = ChildPackageHasArticlesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByArticle($this)
                ->count($con);
        }

        return count($this->collPackageHasArticless);
    }

    /**
     * Method called to associate a ChildPackageHasArticles object to this object
     * through the ChildPackageHasArticles foreign key attribute.
     *
     * @param  ChildPackageHasArticles $l ChildPackageHasArticles
     * @return $this|\Article The current object (for fluent API support)
     */
    public function addPackageHasArticles(ChildPackageHasArticles $l)
    {
        if ($this->collPackageHasArticless === null) {
            $this->initPackageHasArticless();
            $this->collPackageHasArticlessPartial = true;
        }

        if (!$this->collPackageHasArticless->contains($l)) {
            $this->doAddPackageHasArticles($l);

            if ($this->packageHasArticlessScheduledForDeletion and $this->packageHasArticlessScheduledForDeletion->contains($l)) {
                $this->packageHasArticlessScheduledForDeletion->remove($this->packageHasArticlessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPackageHasArticles $packageHasArticles The ChildPackageHasArticles object to add.
     */
    protected function doAddPackageHasArticles(ChildPackageHasArticles $packageHasArticles)
    {
        $this->collPackageHasArticless[]= $packageHasArticles;
        $packageHasArticles->setArticle($this);
    }

    /**
     * @param  ChildPackageHasArticles $packageHasArticles The ChildPackageHasArticles object to remove.
     * @return $this|ChildArticle The current object (for fluent API support)
     */
    public function removePackageHasArticles(ChildPackageHasArticles $packageHasArticles)
    {
        if ($this->getPackageHasArticless()->contains($packageHasArticles)) {
            $pos = $this->collPackageHasArticless->search($packageHasArticles);
            $this->collPackageHasArticless->remove($pos);
            if (null === $this->packageHasArticlessScheduledForDeletion) {
                $this->packageHasArticlessScheduledForDeletion = clone $this->collPackageHasArticless;
                $this->packageHasArticlessScheduledForDeletion->clear();
            }
            $this->packageHasArticlessScheduledForDeletion[]= clone $packageHasArticles;
            $packageHasArticles->setArticle(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Article is new, it will return
     * an empty collection; or if this Article has previously
     * been saved, it will retrieve related PackageHasArticless from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Article.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPackageHasArticles[] List of ChildPackageHasArticles objects
     */
    public function getPackageHasArticlessJoinPackage(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPackageHasArticlesQuery::create(null, $criteria);
        $query->joinWith('Package', $joinBehavior);

        return $this->getPackageHasArticless($query, $con);
    }

    /**
     * Clears out the collRatings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRatings()
     */
    public function clearRatings()
    {
        $this->collRatings = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRatings collection loaded partially.
     */
    public function resetPartialRatings($v = true)
    {
        $this->collRatingsPartial = $v;
    }

    /**
     * Initializes the collRatings collection.
     *
     * By default this just sets the collRatings collection to an empty array (like clearcollRatings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRatings($overrideExisting = true)
    {
        if (null !== $this->collRatings && !$overrideExisting) {
            return;
        }

        $collectionClassName = RatingTableMap::getTableMap()->getCollectionClassName();

        $this->collRatings = new $collectionClassName;
        $this->collRatings->setModel('\Rating');
    }

    /**
     * Gets an array of ChildRating objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildArticle is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRating[] List of ChildRating objects
     * @throws PropelException
     */
    public function getRatings(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRatingsPartial && !$this->isNew();
        if (null === $this->collRatings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRatings) {
                // return empty collection
                $this->initRatings();
            } else {
                $collRatings = ChildRatingQuery::create(null, $criteria)
                    ->filterByArticle($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRatingsPartial && count($collRatings)) {
                        $this->initRatings(false);

                        foreach ($collRatings as $obj) {
                            if (false == $this->collRatings->contains($obj)) {
                                $this->collRatings->append($obj);
                            }
                        }

                        $this->collRatingsPartial = true;
                    }

                    return $collRatings;
                }

                if ($partial && $this->collRatings) {
                    foreach ($this->collRatings as $obj) {
                        if ($obj->isNew()) {
                            $collRatings[] = $obj;
                        }
                    }
                }

                $this->collRatings = $collRatings;
                $this->collRatingsPartial = false;
            }
        }

        return $this->collRatings;
    }

    /**
     * Sets a collection of ChildRating objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $ratings A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildArticle The current object (for fluent API support)
     */
    public function setRatings(Collection $ratings, ConnectionInterface $con = null)
    {
        /** @var ChildRating[] $ratingsToDelete */
        $ratingsToDelete = $this->getRatings(new Criteria(), $con)->diff($ratings);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->ratingsScheduledForDeletion = clone $ratingsToDelete;

        foreach ($ratingsToDelete as $ratingRemoved) {
            $ratingRemoved->setArticle(null);
        }

        $this->collRatings = null;
        foreach ($ratings as $rating) {
            $this->addRating($rating);
        }

        $this->collRatings = $ratings;
        $this->collRatingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Rating objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Rating objects.
     * @throws PropelException
     */
    public function countRatings(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRatingsPartial && !$this->isNew();
        if (null === $this->collRatings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRatings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRatings());
            }

            $query = ChildRatingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByArticle($this)
                ->count($con);
        }

        return count($this->collRatings);
    }

    /**
     * Method called to associate a ChildRating object to this object
     * through the ChildRating foreign key attribute.
     *
     * @param  ChildRating $l ChildRating
     * @return $this|\Article The current object (for fluent API support)
     */
    public function addRating(ChildRating $l)
    {
        if ($this->collRatings === null) {
            $this->initRatings();
            $this->collRatingsPartial = true;
        }

        if (!$this->collRatings->contains($l)) {
            $this->doAddRating($l);

            if ($this->ratingsScheduledForDeletion and $this->ratingsScheduledForDeletion->contains($l)) {
                $this->ratingsScheduledForDeletion->remove($this->ratingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildRating $rating The ChildRating object to add.
     */
    protected function doAddRating(ChildRating $rating)
    {
        $this->collRatings[]= $rating;
        $rating->setArticle($this);
    }

    /**
     * @param  ChildRating $rating The ChildRating object to remove.
     * @return $this|ChildArticle The current object (for fluent API support)
     */
    public function removeRating(ChildRating $rating)
    {
        if ($this->getRatings()->contains($rating)) {
            $pos = $this->collRatings->search($rating);
            $this->collRatings->remove($pos);
            if (null === $this->ratingsScheduledForDeletion) {
                $this->ratingsScheduledForDeletion = clone $this->collRatings;
                $this->ratingsScheduledForDeletion->clear();
            }
            $this->ratingsScheduledForDeletion[]= clone $rating;
            $rating->setArticle(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Article is new, it will return
     * an empty collection; or if this Article has previously
     * been saved, it will retrieve related Ratings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Article.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRating[] List of ChildRating objects
     */
    public function getRatingsJoinPerson(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRatingQuery::create(null, $criteria);
        $query->joinWith('Person', $joinBehavior);

        return $this->getRatings($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCakeType) {
            $this->aCakeType->removeArticle($this);
        }
        if (null !== $this->aShape) {
            $this->aShape->removeArticle($this);
        }
        $this->article_id = null;
        $this->description = null;
        $this->price = null;
        $this->creation = null;
        $this->visible = null;
        $this->shape_id = null;
        $this->cake_type_id = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collArticleHasIngredients) {
                foreach ($this->collArticleHasIngredients as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderHasArticless) {
                foreach ($this->collOrderHasArticless as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPackageHasArticless) {
                foreach ($this->collPackageHasArticless as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRatings) {
                foreach ($this->collRatings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collArticleHasIngredients = null;
        $this->collOrderHasArticless = null;
        $this->collPackageHasArticless = null;
        $this->collRatings = null;
        $this->aCakeType = null;
        $this->aShape = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ArticleTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
