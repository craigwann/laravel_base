<?php namespace Ironquest\Controllers;

use Ironquest\Repos\MilestoneRepoInterface as Milestone;
use Ironquest\Repos\AttributeModifierRepoInterface as AttributeModifier;
use Ironquest\Repos\TargetRepoInterface as Target;
use Ironquest\Repos\RangeRepoInterface as Range;
use Ironquest\Repos\AttunementRepoInterface as Attunement;
use Ironquest\Validators\MilestoneValidator as Validator;

class MilestoneController extends BaseController {

    public function __construct(
        Milestone $milestone,
        AttributeModifier $attributeModifier,
        Target $target,
        Range $range,
        Attunement $attunement,
        Validator $validator
    )
    {
        $this->milestone = $milestone;
        $this->attributeModifier = $attributeModifier;
        $this->target = $target;
        $this->range = $range;
        $this->attunement = $attunement;
        $this->validator = $validator;

        $this->beforeFilter('access:' . \Config::get('auth.userType.player'));

        parent::__construct();
    }

	/**
	 * Display a listing of the resource.
	 * GET /milestone
	 *
	 * @return Response
	 */
	public function index()
	{
        return \View::make('milestone.index', array('milestones' => $this->milestone->allPaginated()));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /milestone/create
	 *
	 * @return Response
	 */
	public function create()
	{
        return \View::make('milestone.create',
            array(
                'attributeModifierOptions' => $this->attributeModifier->listColumnOptions(),
                'targetOptions' => $this->target->listOptions(),
                'attunementOptions' => $this->attunement->listOptions(),
                'rangeOptions' => $this->range->listOptions()
            )
        );
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /milestone
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = $this->validator->make(Input::all());
        if ($validator->fails()) {
            return \Redirect::route('milestones.create')->withInput()->withErrors($validator->messages());
        }

        try {
            $result = $this->milestone->create(Input::all());
        } catch (\Exception $e) {
            return \Redirect::route('milestones.create')->with('message', 'An error has occured.')->with('context', 'danger');
        }

        return \Redirect::route('milestones.edit', array($result))->with('message', 'milestone created!')->with('context', 'success');
	}

	/**
	 * Display the specified resource.
	 * GET /milestone/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return \Redirect::to('/milestone/' . $id . '/edit');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /milestone/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $milestone = $this->milestone->find($id);
        if (!$milestone) {
            return $this->message('No milestone found', $this->not_found_message);
        }

        return \View::make('milestone.edit', $milestone);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /milestone/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = $this->validator->existing()->make(Input::all());
        if ($validator->fails()) {
            return \Redirect::route('milestones.edit')->withInput()->withErrors($validator->messages());
        }
        try {
            $result = $this->milestone->update($id, \Input::all());
        } catch (\Exception $e) {
            return \Redirect::route('milestones.edit')->with('message', 'An error has occurred.')->with('context', 'danger');
        }
        return \Redirect::route('milestones.edit', array($id))->with('message', 'milestone Updated!')->with('context', 'success');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /milestone/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        try {
            $result = $this->milestone->delete($id);
        } catch (\Exception $e) {
            return \Redirect::route('milestones.edit', array($id))->with('message', 'Error deleting milestone!')->with('context', 'danger');
        }
        return \Redirect::route('milestones')->with('message', 'milestone deleted!')->with('context', 'success');
	}
}