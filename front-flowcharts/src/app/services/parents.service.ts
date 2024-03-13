import { Injectable } from '@angular/core';
import { mainEnvironment } from '../../environments/environment';
import { HttpClient } from '@angular/common/http';

export interface ParentResponse {
  "id": number
  "step_id": number
  "step_parent_id": number
}

@Injectable({
  providedIn: 'root'
})
export class ParentsService {

  public base: string = mainEnvironment.SERVER_URL + "stepParents";

  constructor(private httpClient: HttpClient) {}

  getParentsByFlowchartId(flowchartId: number) {
    return this.httpClient.get(`${this.base}/flowchart/${flowchartId}`);
  }

}
