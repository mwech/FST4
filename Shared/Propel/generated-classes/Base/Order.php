<?php

namespace Base;

use \Order as ChildOrder;
use \OrderHasArticles as ChildOrderHasArticles;
use \OrderHasArticlesQuery as ChildOrderHasArticlesQuery;
use \OrderQuery as ChildOrderQuery;
use \Person as ChildPerson;
use \PersonQuery as ChildPersonQuery;
use \Voucher as ChildVoucher;
use \VoucherQuery as ChildVoucherQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\OrderHasArticlesTableMap;
use Map\OrderTableMap;
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
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'order' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Order implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\OrderTableMap';


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
     * The value for the order_id field.
     *
     * @var        string
     */
    protected $order_id;

    /**
     * The value for the date field.
     *
     * @var        DateTime
     */
    protected $date;

    /**
     * The value for the total_amount field.
     *
     * @var        double
     */
    protected $total_amount;

    /**
     * The value for the status field.
     *
     * @var        string
     */
    protected $status;

    /**
     * The value for the person_id field.
     *
     * @var        string
     */
    protected $person_id;

    /**
     * The value for the voucher_id field.
     *
     * @var        string
     */
    protected $voucher_id;

    /**
     * @var        ChildPerson
     */
    protected $aPerson;

    /**
     * @var        ChildVoucher
     */
    protected $aVoucher;

    /**
     * @var        ObjectCollection|ChildOrderHasArticles[] Collection to store aggregation of ChildOrderHasArticles objects.
     */
    protected $collOrderHasArticless;
    protected $collOrderHasArticlessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderHasArticles[]
     */
    protected $orderHasArticlessScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Order object.
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
     * Compares this with another <code>Order</code> instance.  If
     * <code>obj</code> is an instance of <code>Order</code>, delegates to
     * <code>equals(Order)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Order The current object, for fluid interface
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
     * Get the [order_id] column value.
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Get the [optionally formatted] temporal [date] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDate($format = NULL)
    {
        if ($format === null) {
            return $this->date;
        } else {
            return $this->date instanceof \DateTimeInterface ? $this->date->format($format) : null;
        }
    }

    /**
     * Get the [total_amount] column value.
     *
     * @return double
     */
    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    /**
     * Get the [status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [person_id] column value.
     *
     * @return string
     */
    public function getPersonId()
    {
        return $this->person_id;
    }

    /**
     * Get the [voucher_id] column value.
     *
     * @return string
     */
    public function getVoucherId()
    {
        return $this->voucher_id;
    }

    /**
     * Set the value of [order_id] column.
     *
     * @param string $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setOrderId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_id !== $v) {
            $this->order_id = $v;
            $this->modifiedColumns[OrderTableMap::COL_ORDER_ID] = true;
        }

        return $this;
    } // setOrderId()

    /**
     * Sets the value of [date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date !== null || $dt !== null) {
            if ($this->date === null || $dt === null || $dt->format("Y-m-d") !== $this->date->format("Y-m-d")) {
                $this->date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrderTableMap::COL_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setDate()

    /**
     * Set the value of [total_amount] column.
     *
     * @param double $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setTotalAmount($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->total_amount !== $v) {
            $this->total_amount = $v;
            $this->modifiedColumns[OrderTableMap::COL_TOTAL_AMOUNT] = true;
        }

        return $this;
    } // setTotalAmount()

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[OrderTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [person_id] column.
     *
     * @param string $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setPersonId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->person_id !== $v) {
            $this->person_id = $v;
            $this->modifiedColumns[OrderTableMap::COL_PERSON_ID] = true;
        }

        if ($this->aPerson !== null && $this->aPerson->getPersonId() !== $v) {
            $this->aPerson = null;
        }

        return $this;
    } // setPersonId()

    /**
     * Set the value of [voucher_id] column.
     *
     * @param string $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setVoucherId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->voucher_id !== $v) {
            $this->voucher_id = $v;
            $this->modifiedColumns[OrderTableMap::COL_VOUCHER_ID] = true;
        }

        if ($this->aVoucher !== null && $this->aVoucher->getVoucherId() !== $v) {
            $this->aVoucher = null;
        }

        return $this;
    } // setVoucherId()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OrderTableMap::translateFieldName('OrderId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OrderTableMap::translateFieldName('Date', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OrderTableMap::translateFieldName('TotalAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_amount = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OrderTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OrderTableMap::translateFieldName('PersonId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->person_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OrderTableMap::translateFieldName('VoucherId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->voucher_id = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = OrderTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Order'), 0, $e);
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
        if ($this->aPerson !== null && $this->person_id !== $this->aPerson->getPersonId()) {
            $this->aPerson = null;
        }
        if ($this->aVoucher !== null && $this->voucher_id !== $this->aVoucher->getVoucherId()) {
            $this->aVoucher = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(OrderTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOrderQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPerson = null;
            $this->aVoucher = null;
            $this->collOrderHasArticless = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Order::setDeleted()
     * @see Order::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOrderQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderTableMap::DATABASE_NAME);
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
                OrderTableMap::addInstanceToPool($this);
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

            if ($this->aPerson !== null) {
                if ($this->aPerson->isModified() || $this->aPerson->isNew()) {
                    $affectedRows += $this->aPerson->save($con);
                }
                $this->setPerson($this->aPerson);
            }

            if ($this->aVoucher !== null) {
                if ($this->aVoucher->isModified() || $this->aVoucher->isNew()) {
                    $affectedRows += $this->aVoucher->save($con);
                }
                $this->setVoucher($this->aVoucher);
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
        if ($this->isColumnModified(OrderTableMap::COL_ORDER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'order_id';
        }
        if ($this->isColumnModified(OrderTableMap::COL_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'date';
        }
        if ($this->isColumnModified(OrderTableMap::COL_TOTAL_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'total_amount';
        }
        if ($this->isColumnModified(OrderTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(OrderTableMap::COL_PERSON_ID)) {
            $modifiedColumns[':p' . $index++]  = 'person_id';
        }
        if ($this->isColumnModified(OrderTableMap::COL_VOUCHER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'voucher_id';
        }

        $sql = sprintf(
            'INSERT INTO order (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'order_id':
                        $stmt->bindValue($identifier, $this->order_id, PDO::PARAM_STR);
                        break;
                    case 'date':
                        $stmt->bindValue($identifier, $this->date ? $this->date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'total_amount':
                        $stmt->bindValue($identifier, $this->total_amount, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'person_id':
                        $stmt->bindValue($identifier, $this->person_id, PDO::PARAM_STR);
                        break;
                    case 'voucher_id':
                        $stmt->bindValue($identifier, $this->voucher_id, PDO::PARAM_STR);
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
        $pos = OrderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOrderId();
                break;
            case 1:
                return $this->getDate();
                break;
            case 2:
                return $this->getTotalAmount();
                break;
            case 3:
                return $this->getStatus();
                break;
            case 4:
                return $this->getPersonId();
                break;
            case 5:
                return $this->getVoucherId();
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

        if (isset($alreadyDumpedObjects['Order'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Order'][$this->hashCode()] = true;
        $keys = OrderTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOrderId(),
            $keys[1] => $this->getDate(),
            $keys[2] => $this->getTotalAmount(),
            $keys[3] => $this->getStatus(),
            $keys[4] => $this->getPersonId(),
            $keys[5] => $this->getVoucherId(),
        );
        if ($result[$keys[1]] instanceof \DateTimeInterface) {
            $result[$keys[1]] = $result[$keys[1]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aPerson) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'person';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'person';
                        break;
                    default:
                        $key = 'Person';
                }

                $result[$key] = $this->aPerson->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aVoucher) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'voucher';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'voucher';
                        break;
                    default:
                        $key = 'Voucher';
                }

                $result[$key] = $this->aVoucher->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\Order
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OrderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Order
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOrderId($value);
                break;
            case 1:
                $this->setDate($value);
                break;
            case 2:
                $this->setTotalAmount($value);
                break;
            case 3:
                $this->setStatus($value);
                break;
            case 4:
                $this->setPersonId($value);
                break;
            case 5:
                $this->setVoucherId($value);
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
        $keys = OrderTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOrderId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setDate($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTotalAmount($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setStatus($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPersonId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setVoucherId($arr[$keys[5]]);
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
     * @return $this|\Order The current object, for fluid interface
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
        $criteria = new Criteria(OrderTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OrderTableMap::COL_ORDER_ID)) {
            $criteria->add(OrderTableMap::COL_ORDER_ID, $this->order_id);
        }
        if ($this->isColumnModified(OrderTableMap::COL_DATE)) {
            $criteria->add(OrderTableMap::COL_DATE, $this->date);
        }
        if ($this->isColumnModified(OrderTableMap::COL_TOTAL_AMOUNT)) {
            $criteria->add(OrderTableMap::COL_TOTAL_AMOUNT, $this->total_amount);
        }
        if ($this->isColumnModified(OrderTableMap::COL_STATUS)) {
            $criteria->add(OrderTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(OrderTableMap::COL_PERSON_ID)) {
            $criteria->add(OrderTableMap::COL_PERSON_ID, $this->person_id);
        }
        if ($this->isColumnModified(OrderTableMap::COL_VOUCHER_ID)) {
            $criteria->add(OrderTableMap::COL_VOUCHER_ID, $this->voucher_id);
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
        $criteria = ChildOrderQuery::create();
        $criteria->add(OrderTableMap::COL_ORDER_ID, $this->order_id);

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
        $validPk = null !== $this->getOrderId();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getOrderId();
    }

    /**
     * Generic method to set the primary key (order_id column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setOrderId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getOrderId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Order (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setOrderId($this->getOrderId());
        $copyObj->setDate($this->getDate());
        $copyObj->setTotalAmount($this->getTotalAmount());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setPersonId($this->getPersonId());
        $copyObj->setVoucherId($this->getVoucherId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getOrderHasArticless() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderHasArticles($relObj->copy($deepCopy));
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
     * @return \Order Clone of current object.
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
     * Declares an association between this object and a ChildPerson object.
     *
     * @param  ChildPerson $v
     * @return $this|\Order The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPerson(ChildPerson $v = null)
    {
        if ($v === null) {
            $this->setPersonId(NULL);
        } else {
            $this->setPersonId($v->getPersonId());
        }

        $this->aPerson = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPerson object, it will not be re-added.
        if ($v !== null) {
            $v->addOrder($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPerson object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPerson The associated ChildPerson object.
     * @throws PropelException
     */
    public function getPerson(ConnectionInterface $con = null)
    {
        if ($this->aPerson === null && (($this->person_id !== "" && $this->person_id !== null))) {
            $this->aPerson = ChildPersonQuery::create()->findPk($this->person_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPerson->addOrders($this);
             */
        }

        return $this->aPerson;
    }

    /**
     * Declares an association between this object and a ChildVoucher object.
     *
     * @param  ChildVoucher $v
     * @return $this|\Order The current object (for fluent API support)
     * @throws PropelException
     */
    public function setVoucher(ChildVoucher $v = null)
    {
        if ($v === null) {
            $this->setVoucherId(NULL);
        } else {
            $this->setVoucherId($v->getVoucherId());
        }

        $this->aVoucher = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildVoucher object, it will not be re-added.
        if ($v !== null) {
            $v->addOrder($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildVoucher object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildVoucher The associated ChildVoucher object.
     * @throws PropelException
     */
    public function getVoucher(ConnectionInterface $con = null)
    {
        if ($this->aVoucher === null && (($this->voucher_id !== "" && $this->voucher_id !== null))) {
            $this->aVoucher = ChildVoucherQuery::create()->findPk($this->voucher_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVoucher->addOrders($this);
             */
        }

        return $this->aVoucher;
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
        if ('OrderHasArticles' == $relationName) {
            $this->initOrderHasArticless();
            return;
        }
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
     * If this ChildOrder is new, it will return
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
                    ->filterByOrder($this)
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
     * @return $this|ChildOrder The current object (for fluent API support)
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
            $orderHasArticlesRemoved->setOrder(null);
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
                ->filterByOrder($this)
                ->count($con);
        }

        return count($this->collOrderHasArticless);
    }

    /**
     * Method called to associate a ChildOrderHasArticles object to this object
     * through the ChildOrderHasArticles foreign key attribute.
     *
     * @param  ChildOrderHasArticles $l ChildOrderHasArticles
     * @return $this|\Order The current object (for fluent API support)
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
        $orderHasArticles->setOrder($this);
    }

    /**
     * @param  ChildOrderHasArticles $orderHasArticles The ChildOrderHasArticles object to remove.
     * @return $this|ChildOrder The current object (for fluent API support)
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
            $orderHasArticles->setOrder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Order is new, it will return
     * an empty collection; or if this Order has previously
     * been saved, it will retrieve related OrderHasArticless from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Order.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderHasArticles[] List of ChildOrderHasArticles objects
     */
    public function getOrderHasArticlessJoinArticle(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderHasArticlesQuery::create(null, $criteria);
        $query->joinWith('Article', $joinBehavior);

        return $this->getOrderHasArticless($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aPerson) {
            $this->aPerson->removeOrder($this);
        }
        if (null !== $this->aVoucher) {
            $this->aVoucher->removeOrder($this);
        }
        $this->order_id = null;
        $this->date = null;
        $this->total_amount = null;
        $this->status = null;
        $this->person_id = null;
        $this->voucher_id = null;
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
            if ($this->collOrderHasArticless) {
                foreach ($this->collOrderHasArticless as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collOrderHasArticless = null;
        $this->aPerson = null;
        $this->aVoucher = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OrderTableMap::DEFAULT_STRING_FORMAT);
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
