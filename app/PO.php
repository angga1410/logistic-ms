<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PO extends Model
{
    protected $table = 'purchase_order';

    // protected $fillable = ['po_number','po_number_seq','pr_id', 'rfq_id', 'supplier_id', 'supplier_contact_id', 'shipment_term', 'payment_term', 'import_via', 'cost_freight', 'cost_freight_amount', 'vat', 'qs_rating', 'remark', 'attached_file', 'status', 'invoice_status', 'pos_supplier_rating','po_date', 'approved', 'verified','verified_by','approved_by', 'approved_date', 'created_by', 'modified_by'];

    public $timestamps = true;
    
 
}
