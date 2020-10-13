import React from "react";
import { HashRouter as Router, Switch, Route } from "react-router-dom";

//  router imports
import {
  Login,
  Signup,
  Forgot,
  Index,
  Logout,
  Feeds,
  Materiallisitngs,
  Worklistings,
  Createmateriallist,
  Createworklist,
  Materialofferdetails,
  Workdetail,
  Savedjobs,
  Myaccount,
  ListDetails,
  Mycontracts,
  Reset,
  Confirmed,
} from "./router/materialRouter";
import {
  Dashboard,
  MyResources,
  ResourceListing,
  ProjectPlanning,
  BusinessProposal,
  BusinessPropsalCreate,
  Agreement,
  AgreementCreate,
  MyCustomers,
  CustomerListings,
  Invoice,
  InvoiceListing,
  ProposalListing,
  AgreementListing,
  Phase,
  PhaseListing,
} from "./router/bussinessRouter";

// stylesheets
import "./style.css";
import "./icomoon.css";
import "./jquery.multiselect.css";

function App() {
  return (
    <div className="App">
      <Router>
        {/* marketplace starts */}
        <Switch>
          <Route exact path="/" component={Login} />
          <Route exact path="/register" component={Signup} />
          <Route exact path="/forgot" component={Forgot} />
          <Route exact path="/reset/:token?" component={Reset} />
          <Route exact path="/confirmed" component={Confirmed} />
          <Route exact path="/index" component={Index} />
          <Route exact path="/logout" component={Logout} />
          <Route exact path="/feeds" component={Feeds} />
          <Route exact path="/material-list" component={Materiallisitngs} />
          <Route exact path="/work-list" component={Worklistings} />
          <Route
            exact
            path="/create-material-list"
            component={Createmateriallist}
          />
          <Route exact path="/create-work-list" component={Createworklist} />
          <Route
            exact
            path="/material-offer-detail/:id"
            component={Materialofferdetails}
          />
          <Route exact path="/work-detail/:id" component={Workdetail} />
          <Route exact path="/saved" component={Savedjobs} />
          <Route exact path="/myaccount" component={Myaccount} />
          <Route exact path="/listing-detail/:id" component={ListDetails} />
          <Route exact path="/my-contracts" component={Mycontracts} />
        </Switch>
        {/* marketplace ends */}

        {/* my bussiness starts */}
        <Switch>
          <Route exact path="/business-dashboard" component={Dashboard} />
          <Route exact path="/myresources" component={MyResources} />
          <Route exact path="/myresources/:id" component={MyResources} />
          <Route exact path="/resource-list" component={ResourceListing} />
          <Route
            exact
            path="/propsal-projectplanning"
            component={ProjectPlanning}
          />
          <Route exact path="/myproposal" component={BusinessProposal} />
          <Route exact path="/proposal-listing" component={ProposalListing} />
          <Route
            exact
            path="/business-propsal-create/:tender?/:customer?/:draft?"
            component={BusinessPropsalCreate}
          />
          <Route exact path="/myagreement" component={Agreement} />
          <Route exact path="/agreement-listing" component={AgreementListing} />
          <Route
            exact
            path="/business-agreement-create/:tender?/:customer?/:draft?"
            component={AgreementCreate}
          />
          <Route exact path="/mycustomers" component={MyCustomers} />
          <Route exact path="/mycustomers/:id" component={MyCustomers} />
          <Route exact path="/customers-list" component={CustomerListings} />
          <Route exact path="/invoice" component={Invoice} />
          <Route exact path="/invoice-list" component={InvoiceListing} />
          <Route exact path="/myphases/:id?" component={Phase} />
          <Route exact path="/phase-list" component={PhaseListing} />
        </Switch>
        {/* my bussiness ends */}
      </Router>
    </div>
  );
}

export default App;
