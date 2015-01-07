<?php

class MilestoneController extends \BaseController {

    function __construct(
        MilestoneRepository $milestoneRepository,
        AbilityRepository $abilityRepository,
        AttributeModifierRepository $attributeModifierRepository,
        TargetRepository $targetRepository,
        AttunementRepository $attunementRepository
    )
    {
        $this->milestone = $milestoneRepository;
        $this->ability = $abilityRepository;
        $this->attributeModifier = $attributeModifierRepository;
        $this->target = $targetRepository;
        $this->attunement = $attunementRepository;
        $this->beforeFilter('access:' . Config::get('auth.userType.player'));
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $milestones = $this->milestone->index(15);
        return View::make('milestone.index', array('milestones' => $milestones));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('milestone.create',
            array(
                'attributeModifierOptions' => $this->attributeModifier->listColumnOptions(),
                'targetOptions' => $this->target->listOptions(),
                'attunementOptions' => $this->attunement->listOptions()
            )
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $result = $this->milestone->store(Input::all());
        if (!$result) {
            return Redirect::route('milestones.create')->withInput()->withErrors($this->milestone->errors());
        } else {
            return Redirect::route('milestones.edit', array($result))->with('message', 'milestone created!')->with('context', 'success');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Redirect::to('/milestone/' . $id . '/edit');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $milestone = $this->milestone->withTrashed()->find($id);
        if (!$milestone) {
            return $this->message('No milestone found', $this->not_found_message);
        }
        $data = $milestone->with('milestoneType')->first();

        $data['milestoneTypeOptions'] = $this->milestoneType->listOptions();

        return View::make('milestone.edit', $data)->with('milestone', $milestone);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $result = $this->milestone->update($id, Input::all());
        if (!$result) {
            return Redirect::route('milestones.edit', array($id))->withInput()->withErrors($this->milestone->errors());
        } else {
            return Redirect::route('milestones.edit', array($id))->with('message', 'milestone updated!')->with('context', 'success');
        }
    }

    public function destroy($id)
    {
        $result = $this->milestone->destroy($id);
        if (!$result) {
            return Redirect::route('milestones.edit', array($id))->with('danger', 'Error deactivating milestone!')->with('context', 'danger');
        } else {
            return Redirect::route('milestones.edit', array($id))->with('message', 'milestone deactivated!')->with('context', 'success');
        }
    }

    public function revive($id)
    {
        $result = $this->milestone->revive($id);
        if (!$result) {
            var_dump($this->milestone->errors());
            exit;
            return Redirect::route('milestones.edit', array($id))->with('danger', 'Error reviving milestone!')->with('context', 'danger');
        } else {
            return Redirect::route('milestones.edit', array($id))->with('message', 'milestone revived!')->with('context', 'success');
        }
    }
}
